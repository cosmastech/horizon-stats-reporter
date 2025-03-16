<?php

namespace Cosmastech\HorizonStatsReporterTests\Integration;

use Cosmastech\HorizonStatsReporter\Listeners\HorizonJobFailedListener;
use Illuminate\Support\Facades\Event;
use Laravel\Horizon\Events\JobFailed;
use PHPUnit\Framework\Attributes\Test;

class HorizonStatsReporterServiceProviderTest extends BaseIntegrationTest
{
    #[Test]
    public function listensForHorizonJobFailed(): void
    {
        Event::fake();
        Event::assertListening(
            JobFailed::class,
            HorizonJobFailedListener::class
        );
    }
}