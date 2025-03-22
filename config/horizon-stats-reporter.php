<?php

use Cosmastech\HorizonStatsReporter\StatEnum;

return [
    'stat_names' => [
        'job_failed' => StatEnum::JOB_FAILED->value,
        'queue_jobs' => StatEnum::QUEUE_JOBS->value,
        'queue_processes' => StatEnum::QUEUE_PROCESSES->value,
        'queue_wait' => StatEnum::QUEUE_WAIT->value,
        'supervisor_oom' => StatEnum::SUPERVISOR_OUT_OF_MEMORY->value,
    ],
];
