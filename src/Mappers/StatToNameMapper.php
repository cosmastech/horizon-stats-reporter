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
        $configuredValue = $this->config->get('horizon-stats-reporter.stat_names.'.$statEnum->value);

        if ($configuredValue === null) {
            throw InvalidConfigurationException::forStats([$statEnum]);
        }

        return (string) value($configuredValue);
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
