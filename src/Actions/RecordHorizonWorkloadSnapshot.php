<?php

namespace Cosmastech\HorizonStatsReporter\Actions;

use Cosmastech\HorizonStatsReporter\Mappers\StatToNameMapper;
use Cosmastech\StatsDClientAdapter\Adapters\StatsDClientAdapter;
use Laravel\Horizon\Contracts\WorkloadRepository;

/**
 * @phpstan-type WorkloadType array{"name": string, "length": int, "wait": int, "processes": int, "split_queues": null|array<int, SplitQueueType>}
 * @phpstan-type SplitQueueType array{"name": string, "wait": int, "length": int}
 */
class RecordHorizonWorkloadSnapshot
{
    public function __construct(
        protected WorkloadRepository $workloadRepository,
        protected StatsDClientAdapter $statsClient,
        protected StatToNameMapper $statToNameMapper,
    ) {
    }

    public function handle(): void
    {
        $workloads = $this->gatherWorkloads();

        array_map($this->recordWorkload(...), $workloads);
    }

    /**
     * @return array<int, WorkloadType>
     */
    protected function gatherWorkloads(): array
    {
        return $this->workloadRepository->get();
    }

    /**
     * @param  WorkloadType $workload
     * @return void
     */
    protected function recordWorkload(array $workload): void
    {
        $queueName = $workload['name'];

        $this->statsClient->gauge(
            $this->statToNameMapper->forProcessesPerQueue($queueName),
            floatval($workload['processes'])
        );

        $this->statsClient->gauge(
            $this->statToNameMapper->forWaitForQueue($queueName),
            floatval($workload['wait'])
        );

        $this->statsClient->gauge(
            $this->statToNameMapper->forJobsForQueue($queueName),
            floatval($workload['length'])
        );
    }
}
