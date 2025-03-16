<?php

namespace Cosmastech\HorizonStatsReporter\Actions;

use Cosmastech\HorizonStatsReporter\StatEnum;
use Cosmastech\StatsDClientAdapter\Adapters\StatsDClientAdapter;
use Illuminate\Support\Collection;
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
    ) {
    }

    public function handle(): void
    {
        /** @see \Laravel\Horizon\Http\Controllers\WorkloadController */
        $workloads = $this->gatherWorkloads();

        array_map($this->recordWorkload(...), $workloads);
    }

    /**
     * @return list<WorkloadType>
     */
    protected function gatherWorkloads(): array
    {
        // @phpstan-ignore-next-line
        return (new Collection($this->workloadRepository->get()))
            ->sortBy('name')
            ->values()
            ->toArray();
    }

    /**
     * @param  WorkloadType $workload
     * @return void
     */
    protected function recordWorkload(array $workload): void
    {
        $queueName = $workload['name'];

        $this->statsClient->gauge(
            StatEnum::processesForQueue($queueName),
            floatval($workload['processes'])
        );

        $this->statsClient->gauge(
            StatEnum::waitForQueue($queueName),
            floatval($workload['wait'])
        );

        $this->statsClient->gauge(
            StatEnum::jobsForQueue($queueName),
            floatval($workload['length'])
        );
    }
}
