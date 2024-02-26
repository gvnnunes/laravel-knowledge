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
        Event::factory()
            ->hasAttached(
                Participant::factory()->count(rand(3, 10)),
                [],
            )
            ->hasAttached(
                Speaker::factory()->count(rand(1, 4)),
                [],
            )
            ->hasAttached(
                EventCategory::factory()->count(rand(1, 3)),
                [],
            )
            ->count(5)
            ->create();
    }
}
