<?php

namespace Cosmastech\HorizonStatsReporter;

use Cosmastech\HorizonStatsReporter\Exceptions\InvalidConfigurationException;
use Cosmastech\HorizonStatsReporter\Listeners\HorizonJobFailedListener;
use Cosmastech\HorizonStatsReporter\Listeners\HorizonSupervisorOutOfMemoryListener;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Events\JobFailed;
use Laravel\Horizon\Events\MasterSupervisorOutOfMemory;
use Laravel\Horizon\Events\SupervisorOutOfMemory;

class HorizonStatsReporterServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/horizon-stats-reporter.php',
            'horizon-stats-reporter'
        );

        $this->offerPublishing();
        //$this->assertValidConfig();

        Event::listen(
            JobFailed::class,
            HorizonJobFailedListener::class
        );

        Event::listen(
            MasterSupervisorOutOfMemory::class,
            HorizonSupervisorOutOfMemoryListener::class
        );

        Event::listen(
            SupervisorOutOfMemory::class,
            HorizonSupervisorOutOfMemoryListener::class
        );
    }

    protected function offerPublishing(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/horizon-stats-reporter.php' => config_path('horizon-stats-reporter.php'),
        ], 'horizon-stats-reporter');
    }

    /**
     * @throws InvalidConfigurationException
     */
    protected function assertValidConfig(): void
    {
        $userStatToEnum = $this->app
            ->make(Repository::class)
            ->get('horizon-stats-reporter.stat_names', []);

        $missing = [];
        foreach (StatEnum::cases() as $statEnum) {
            if (! in_array($statEnum, $userStatToEnum)) {
                $missing[] = $statEnum;
            }
        }

        if ($missing !== []) {
            throw InvalidConfigurationException::forStats($missing);
        }
    }
}
