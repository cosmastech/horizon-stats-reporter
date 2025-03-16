<?php

namespace Cosmastech\HorizonStatsReporterTests\Integration;

use Cosmastech\HorizonStatsReporter\Listeners\HorizonJobFailedListener;
use Illuminate\Support\Facades\Event;
use Laravel\Horizon\Events\JobFailed;
use PHPUnit\Framework\Attributes\Test;

final class HorizonStatsReporterServiceProviderTest extends BaseIntegrationTestCase
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
