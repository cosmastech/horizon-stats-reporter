<?php

namespace Cosmastech\HorizonStatsReporter\TagBuilders;

use Laravel\Horizon\Events\JobFailed;

class FailedJobTagBuilder
{
    /**
     * @param  JobFailed  $jobFailed
     * @return array<string, mixed>
     */
    public function forJobFailed(JobFailed $jobFailed): array
    {
        return [
            'queue' => $jobFailed->queue,
            'connection' => $jobFailed->connectionName,
            'job' => $jobFailed->job->resolveName(),
        ];
    }
}
