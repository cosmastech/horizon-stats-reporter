<?php

namespace Cosmastech\HorizonStatsReporter\Mappers;

use Cosmastech\HorizonStatsReporter\Exceptions\InvalidConfigurationException;
use Cosmastech\HorizonStatsReporter\StatEnum;
use Illuminate\Container\Attributes\Config;

class StatToNameMapper
{
    /**
     * @param  array<string, StatEnum|\Closure>  $statToEnum
     */
    public function __construct(
        #[Config('horizon-stats-reporter.stat_names')]
        protected array $statToEnum
    ) {
    }

    /**
     * @param  StatEnum  $statEnum
     * @return string
     * @throws InvalidConfigurationException
     */
    public function mapStatEnumToString(StatEnum $statEnum): string
    {
        foreach ($this->statToEnum as $key => $value) {
            if ($value === $statEnum) {
                return (string) value($key, $statEnum);
            }
        }

        throw InvalidConfigurationException::forStats([$statEnum]);
    }

    public function forProcessesPerQueue(string $queueName): string
    {
        return $this->mapStatEnumToString(StatEnum::QUEUE_PROCESSES) . '.'. $queueName;
    }

    public function forWaitForQueue(string $queueName): string
    {
        return $this->mapStatEnumToString(StatEnum::QUEUE_WAIT).'.'.$queueName;
    }

    public function forJobsForQueue(string $queueName): string
    {
        return $this->mapStatEnumToString(StatEnum::QUEUE_JOBS).'.'.$queueName;
    }
}
