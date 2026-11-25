<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiAnalysis extends Model
{
    use HasFactory;

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
        'structured_profile',
        'role_recommendations',
        'matched_skills',
        'skill_gaps',
        'career_roadmap',
        'learning_recommendations',
        'analysis_source',
        'status',
    ];

    protected $casts = [
        'strengths' => 'array',
        'weaknesses' => 'array',
        'missing_skills' => 'array',
        'recommended_skills' => 'array',
        'ats_suggestions' => 'array',
        'structured_profile' => 'array',
        'role_recommendations' => 'array',
        'matched_skills' => 'array',
        'skill_gaps' => 'array',
        'career_roadmap' => 'array',
        'learning_recommendations' => 'array',
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
