<?php

namespace Cosmastech\HorizonStatsReporter\Listeners;

use Cosmastech\HorizonStatsReporter\Mappers\StatToNameMapper;
use Cosmastech\HorizonStatsReporter\StatEnum;
use Cosmastech\HorizonStatsReporter\TagBuilders\OutOfMemoryTagBuilder;
use Cosmastech\StatsDClientAdapter\Adapters\StatsDClientAdapter;
use Laravel\Horizon\Events\MasterSupervisorOutOfMemory;

class MasterSupervisorOutOfMemoryListener
{
    public function __construct(
        protected StatsDClientAdapter $statsClient,
        protected StatToNameMapper $statNameMapper,
        protected OutOfMemoryTagBuilder $outOfMemoryTagBuilder
    ) {
    }

    public function handle(MasterSupervisorOutOfMemory $event): void
    {
        $this->statsClient->increment(
            $this->statNameMapper->mapStatEnumToString(StatEnum::MASTER_SUPERVISOR_OUT_OF_MEMORY),
            tags: $this->outOfMemoryTagBuilder->forMasterSupervisorOutOfMemory($event),
        );
    }
}
