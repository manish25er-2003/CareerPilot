<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InterviewSession extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'difficulty',
        'category',
        'status',
        'total_score',
        'summary',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(InterviewQuestion::class);
    }
}
