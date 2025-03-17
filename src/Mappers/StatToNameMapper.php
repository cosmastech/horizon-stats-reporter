<?php

namespace Cosmastech\HorizonStatsReporter\Mappers;

use Cosmastech\HorizonStatsReporter\Exceptions\InvalidConfigurationException;
use Cosmastech\HorizonStatsReporter\StatEnum;
use Illuminate\Config\Repository;

class StatToNameMapper
{
    public function __construct(
        protected Repository $config
    ) {
    }

    /**
     * @param  StatEnum  $statEnum
     * @return string
     * @throws InvalidConfigurationException
     */
    public function mapStatEnumToString(StatEnum $statEnum): string
    {
        foreach ($this->config->get('horizon-stats-reporter.stat_names', []) as $key => $value) {
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
