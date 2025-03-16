<?php

namespace Cosmastech\HorizonStatsReporter\Listeners;

use Cosmastech\HorizonStatsReporter\StatEnum;
use Cosmastech\HorizonStatsReporter\TagBuilders\FailedJobTagBuilder;
use Cosmastech\StatsDClientAdapter\Adapters\StatsDClientAdapter;
use Laravel\Horizon\Events\JobFailed;

class HorizonJobFailedListener
{
    public function __construct(
        protected StatsDClientAdapter $statsClient,
        protected FailedJobTagBuilder $tagBuilder,
    ) {
    }

    public function handle(JobFailed $jobFailed): void
    {
        $this->statsClient->increment(
            StatEnum::JOB_FAILED,
            tags: $this->tagBuilder->forJobFailed($jobFailed)
        );
    }
}
