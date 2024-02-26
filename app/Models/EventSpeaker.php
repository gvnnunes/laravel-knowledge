<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EventSpeaker extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'speaker_id',
    ];
}
