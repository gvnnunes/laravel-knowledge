<?php

namespace App\Observers;

use App\Models\Speaker;
use Illuminate\Support\Facades\Cache;

class SpeakerObserver
{
    /**
     * Handle the Speaker "created" event.
     */
    public function created(Speaker $speaker): void
    {
        Cache::forget('speakers');
    }

    /**
     * Handle the Speaker "updated" event.
     */
    public function updated(Speaker $speaker): void
    {
        Cache::forget('speakers');
    }

    /**
     * Handle the Speaker "deleted" event.
     */
    public function deleted(Speaker $speaker): void
    {
        Cache::forget('speakers');
    }
}
