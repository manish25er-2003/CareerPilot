<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'professional_headline' => $this->professional_headline,
            'location' => $this->location,
            'experience_years' => $this->experience_years,
            'bio' => $this->bio,
            'linkedin_url' => $this->linkedin_url,
            'github_url' => $this->github_url,
            'portfolio_url' => $this->portfolio_url,
            'profile_score' => $this->profile_score,
        ];
    }
}
