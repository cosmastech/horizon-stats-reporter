<?php

namespace Cosmastech\HorizonStatsReporter\ConsoleCommands;

use Cosmastech\HorizonStatsReporter\Actions\RecordHorizonSnapshots;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('horizon-stats:report')]
class ReportHorizonStatsCommand extends Command
{
    protected $signature = 'horizon-stats:report';

    protected $description = 'Report Horizon metrics to statsd';

    public function handle(RecordHorizonSnapshots $recorder): int
    {
        $recorder->handle();

        $this->info("Successfully recorded.");

        return Command::SUCCESS;
    }
}
