<?php

namespace Cosmastech\HorizonStatsReporter;

enum StatEnum: string
{
    case JOB_FAILED = 'job_failed';
    case MASTER_SUPERVISOR_OUT_OF_MEMORY = 'master_supervisor_oom';
    case QUEUE_WAIT = 'queue_wait';
    case QUEUE_PROCESSES = 'queue_processes';
    case QUEUE_JOBS = 'queue_jobs';
    case SUPERVISOR_OUT_OF_MEMORY = 'supervisor_oom';


    public static function waitForQueue(string $queueName): string
    {
        return self::QUEUE_WAIT->value .':'.$queueName;
    }

    public static function processesForQueue(string $queueName): string
    {
        return self::QUEUE_PROCESSES->value .':'.$queueName;
    }

    public static function jobsForQueue(string $queueName): string
    {
        return self::QUEUE_JOBS->value .':'.$queueName;
    }

}
