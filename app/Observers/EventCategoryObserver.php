<?php

namespace App\Observers;

use App\Models\EventCategory;
use Illuminate\Support\Facades\Cache;

class EventCategoryObserver
{
    /**
     * Handle the EventCategory "created" event.
     */
    public function created(EventCategory $eventCategory): void
    {
        Cache::forget('eventCategories');
    }

    /**
     * Handle the EventCategory "updated" event.
     */
    public function updated(EventCategory $eventCategory): void
    {
        Cache::forget('eventCategories');
    }

    /**
     * Handle the EventCategory "deleted" event.
     */
    public function deleted(EventCategory $eventCategory): void
    {
        Cache::forget('eventCategories');
    }
}
