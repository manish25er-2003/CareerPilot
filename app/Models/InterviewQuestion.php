<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InterviewQuestion extends Model
{
    protected $fillable = [
        'interview_session_id',
        'question',
        'difficulty',
        'category',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(InterviewSession::class, 'interview_session_id');
    }

    public function answer(): HasOne
    {
        return $this->hasOne(InterviewAnswer::class);
    }
}
