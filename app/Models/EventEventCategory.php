<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EventEventCategory extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'event_category_id',
    ];
}
