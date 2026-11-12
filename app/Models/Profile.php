<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'profile_image',
        'professional_headline',
        'location',
        'education',
        'experience_years',
        'bio',
        'linkedin_url',
        'github_url',
        'portfolio_url',
        'profile_score',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class)->withPivot(['proficiency_level'])->withTimestamps();
    }
}
