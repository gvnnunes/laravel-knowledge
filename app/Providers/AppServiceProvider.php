<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Participant;
use App\Models\Speaker;
use App\Observers\EventCategoryObserver;
use App\Observers\EventObserver;
use App\Observers\ParticipantObserver;
use App\Observers\SpeakerObserver;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
        Event::observe(EventObserver::class);
        Participant::observe(ParticipantObserver::class);
        Speaker::observe(SpeakerObserver::class);
        EventCategory::observe(EventCategoryObserver::class);
    }
}
