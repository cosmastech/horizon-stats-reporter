<?php

namespace Cosmastech\HorizonStatsReporter\Actions;

class RecordHorizonSnapshots
{
    public function __construct(
        protected RecordHorizonWorkloadSnapshot $workloadSnapshotter,
    ) {
    }

    public function handle(): void
    {
        $this->workloadSnapshotter->handle();
    }
}
