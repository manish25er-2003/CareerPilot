<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
    ];

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class)->withPivot(['proficiency_level'])->withTimestamps();
    }
}
