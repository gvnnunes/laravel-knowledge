<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Participant;
use App\Models\Speaker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $events = Event::factory()->count(20)->create();
        $participants = Participant::factory()->count(100)->create();
        $speakers = Speaker::factory()->count(20)->create();
        $eventCategories = EventCategory::factory()->count(10)->create();


        $events->map(function ($event) use ($participants, $speakers, $eventCategories) {
            $participantIds = $participants->pluck('id')->shuffle()->slice(0, rand(1, $event->capacity))->all();
            $speakerIds = $speakers->pluck('id')->shuffle()->slice(0, rand(1, 5))->all();
            $categoryIds = $eventCategories->pluck('id')->shuffle()->slice(0, rand(1, 3))->all();

            $event->participants()->attach($participantIds);
            $event->speakers()->attach($speakerIds);
            $event->eventCategories()->attach($categoryIds);
        });
    }
}
