<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AiAnalysisResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'job_title' => $this->job_title,
            'match_percentage' => $this->match_percentage,
            'overall_score' => $this->overall_score,
            'summary' => $this->summary,
            'missing_skills' => $this->missing_skills,
            'recommended_skills' => $this->recommended_skills,
            'strengths' => $this->strengths,
            'weaknesses' => $this->weaknesses,
            'ats_suggestions' => $this->ats_suggestions,
            'structured_profile' => $this->structured_profile,
            'role_recommendations' => $this->role_recommendations,
            'matched_skills' => $this->matched_skills,
            'skill_gaps' => $this->skill_gaps,
            'career_roadmap' => $this->career_roadmap,
            'learning_recommendations' => $this->learning_recommendations,
            'analysis_source' => $this->analysis_source,
            'created_at' => $this->created_at,
        ];
    }
}
