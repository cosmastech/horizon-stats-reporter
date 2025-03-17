<?php

use Cosmastech\HorizonStatsReporter\StatEnum;

return [
    'stat_names' => [
        'job_failed' => StatEnum::JOB_FAILED,
        'queue_jobs' => StatEnum::QUEUE_JOBS,
        'queue_processes' => StatEnum::QUEUE_PROCESSES,
        'queue_wait' => StatEnum::QUEUE_WAIT,
    ],
];
