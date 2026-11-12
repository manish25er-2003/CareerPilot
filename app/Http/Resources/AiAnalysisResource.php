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
        ];
    }
}
