<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiAnalysis extends Model
{
    protected $table = 'ai_analyses';

    protected $fillable = [
        'user_id',
        'resume_id',
        'job_title',
        'job_description',
        'overall_score',
        'match_percentage',
        'strengths',
        'weaknesses',
        'missing_skills',
        'recommended_skills',
        'ats_suggestions',
        'summary',
        'status',
    ];

    protected $casts = [
        'strengths' => 'array',
        'weaknesses' => 'array',
        'missing_skills' => 'array',
        'recommended_skills' => 'array',
        'ats_suggestions' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
