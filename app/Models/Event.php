<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date_time',
        'location',
    ];

    // Makes model convert to Carbon automatically
    protected $dates = ['date_time'];

    public function participants() : BelongsToMany
    {
        return $this->belongsToMany(Participant::class)->withTimestamps();
    }

    public function speakers() : BelongsToMany
    {
        return $this->belongsToMany(Speaker::class)->withTimestamps();
    }

    public function eventCategories() : BelongsToMany
    {
        return $this->belongsToMany(EventCategory::class)->withTimestamps();
    }
}
