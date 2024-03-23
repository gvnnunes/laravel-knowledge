<?php

namespace App\Observers;

use App\Models\Participant;
use Illuminate\Support\Facades\Cache;

class ParticipantObserver
{
    /**
     * Handle the Participant "created" event.
     */
    public function created(Participant $participant): void
    {
        Cache::forget('participants');
    }

    /**
     * Handle the Participant "updated" event.
     */
    public function updated(Participant $participant): void
    {
        Cache::forget('participants');
    }

    /**
     * Handle the Participant "deleted" event.
     */
    public function deleted(Participant $participant): void
    {
        Cache::forget('participants');
    }
}
