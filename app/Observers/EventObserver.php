<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Cache;

class EventObserver
{
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        Cache::forget('events');
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        Cache::forget('events');
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        Cache::forget('events');
    }
}
