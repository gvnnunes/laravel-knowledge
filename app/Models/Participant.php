<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function events() : BelongsToMany
    {
        return $this->belongsToMany(Event::class)->withTimestamps();
    }

    public function readableModelName()
    {
        return 'Participant';
    }
}
