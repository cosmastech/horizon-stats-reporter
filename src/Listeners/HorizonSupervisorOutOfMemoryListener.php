<?php

namespace Cosmastech\HorizonStatsReporter\Listeners;

use Cosmastech\HorizonStatsReporter\Mappers\StatToNameMapper;
use Cosmastech\HorizonStatsReporter\StatEnum;
use Cosmastech\HorizonStatsReporter\TagBuilders\OutOfMemoryTagBuilder;
use Cosmastech\StatsDClientAdapter\Adapters\StatsDClientAdapter;
use Laravel\Horizon\Events\SupervisorOutOfMemory;

class HorizonSupervisorOutOfMemoryListener
{
    public function __construct(
        protected StatsDClientAdapter $statsClient,
        protected StatToNameMapper $statNameMapper,
        protected OutOfMemoryTagBuilder $outOfMemoryTagBuilder
    ) {
    }

    public function handle(SupervisorOutOfMemory $event): void
    {
        $this->statsClient->increment(
            $this->statNameMapper->mapStatEnumToString(StatEnum::SUPERVISOR_OUT_OF_MEMORY),
            tags: $this->outOfMemoryTagBuilder->forSupervisorOutOfMemory($event),
        );
    }
}
