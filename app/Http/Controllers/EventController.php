<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $headers = [
            ['title' => 'ID', 'key' => 'id'],
            ['title' => 'Name', 'key' => 'name'],
            ['title' => 'Description', 'key' => 'description', 'width' => '400px'],
            ['title' => 'Date & Time', 'key' => 'date_time'],
            ['title' => 'Location', 'key' => 'location'],
            ['title' => 'Participants', 'key' => 'participants_count'],
        ];

        return Inertia::render('Events/Index', [
            'headers' => $headers,
        ]);
    }
}
