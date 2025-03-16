<?php

namespace Cosmastech\HorizonStatsReporter;

use Cosmastech\HorizonStatsReporter\Listeners\HorizonJobFailedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Events\JobFailed;

class HorizonStatsReporterServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->offerPublishing();

        Event::listen(
            JobFailed::class,
            HorizonJobFailedListener::class
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
}
