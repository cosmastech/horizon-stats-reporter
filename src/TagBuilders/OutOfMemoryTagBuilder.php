<?php

namespace Cosmastech\HorizonStatsReporter\TagBuilders;

use Laravel\Horizon\Events\MasterSupervisorOutOfMemory;
use Laravel\Horizon\Events\SupervisorOutOfMemory;

class OutOfMemoryTagBuilder
{
    /**
     * @param  SupervisorOutOfMemory  $event
     * @return array<string, mixed>
     */
    public function forSupervisorOutOfMemory(SupervisorOutOfMemory $event): array
    {
        return [];
    }

    /**
     * @param  MasterSupervisorOutOfMemory  $event
     * @return array<string, mixed>
     */
    public function forMasterSupervisorOutOfMemory(MasterSupervisorOutOfMemory $event): array
    {
        return [];
    }
}
