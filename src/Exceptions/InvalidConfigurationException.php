<?php

namespace Cosmastech\HorizonStatsReporter\Exceptions;

use Cosmastech\HorizonStatsReporter\StatEnum;
use RuntimeException;

class InvalidConfigurationException extends RuntimeException
{
    /**
     * @param  list<StatEnum>  $missingStats
     * @return self
     */
    public static function forStats(array $missingStats): self
    {
        $message = 'HorizonStatsReporter requires all stats to be mapped to a string, but the following were missing: ';
        $message .= implode(', ', array_map(fn (StatEnum $statEnum) => $statEnum->value, $missingStats));
        $message .= '.';

        return new self($message);
    }
}
