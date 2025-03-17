<?php

namespace Cosmastech\HorizonStatsReporter;

enum StatEnum: string
{
    case JOB_FAILED = 'job_failed';
    case QUEUE_WAIT = 'queue_wait';
    case QUEUE_PROCESSES = 'queue_processes';
    case QUEUE_JOBS = 'queue_jobs';

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
