<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InterviewAnswer extends Model
{
    protected $fillable = [
        'interview_question_id',
        'answer_text',
        'score',
        'feedback',
        'strengths',
        'weaknesses',
        'suggested_answer',
    ];

    protected $casts = [
        'strengths' => 'array',
        'weaknesses' => 'array',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(InterviewQuestion::class, 'interview_question_id');
    }
}
