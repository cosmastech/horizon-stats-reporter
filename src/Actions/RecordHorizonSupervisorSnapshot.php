<?php

namespace Cosmastech\HorizonStatsReporter\Actions;

use Cosmastech\StatsDClientAdapter\Adapters\StatsDClientAdapter;
use Laravel\Horizon\Contracts\MasterSupervisorRepository;

class RecordHorizonSupervisorSnapshot
{
    public function __construct(
        protected StatsDClientAdapter $statsClient,
        protected MasterSupervisorRepository $supervisorRepository,
    ) {
    }
    public function handle(): void
    {
        $allSupervisors = $this->supervisorRepository->all();

    }
}
