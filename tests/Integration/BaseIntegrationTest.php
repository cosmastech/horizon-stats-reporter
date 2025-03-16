<?php

namespace Cosmastech\HorizonStatsReporterTests\Integration;

use Cosmastech\HorizonStatsReporter\HorizonStatsReporterServiceProvider;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase;
use Override;

abstract class BaseIntegrationTest extends TestCase
{
    use WithWorkbench;

    protected $enablesPackageDiscoveries = true;

    #[Override]
    protected function getPackageProviders($app)
    {
        return [
            HorizonStatsReporterServiceProvider::class,
        ];
    }

    #[Override]
    protected function getEnvironmentSetUp($app)
    {
        /** @var \Illuminate\Config\Repository $config */
        $config = $app->make('config');

        $config->set('horizon-stats-reporter', include __DIR__ .'/../../config/horizon-stats-reporter.php');
    }
}
