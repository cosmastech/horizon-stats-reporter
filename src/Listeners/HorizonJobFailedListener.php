<?php

namespace Cosmastech\HorizonStatsReporter\Listeners;

use Cosmastech\HorizonStatsReporter\Mappers\StatToNameMapper;
use Cosmastech\HorizonStatsReporter\StatEnum;
use Cosmastech\HorizonStatsReporter\TagBuilders\FailedJobTagBuilder;
use Cosmastech\StatsDClientAdapter\Adapters\StatsDClientAdapter;
use Laravel\Horizon\Events\JobFailed;

class HorizonJobFailedListener
{
    public function __construct(
        protected StatsDClientAdapter $statsClient,
        protected StatToNameMapper $statNameMapper,
        protected FailedJobTagBuilder $tagBuilder,
    ) {
    }

    public function handle(JobFailed $jobFailed): void
    {
        $this->statsClient->increment(
            $this->statNameMapper->mapStatEnumToString(StatEnum::JOB_FAILED),
            tags: $this->tagBuilder->forJobFailed($jobFailed)
        );
    }
}
