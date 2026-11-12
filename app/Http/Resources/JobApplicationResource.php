<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company_name,
            'job_title' => $this->job_title,
            'status' => $this->status,
            'location' => $this->location,
            'job_type' => $this->job_type,
            'applied_at' => $this->applied_at,
        ];
    }
}
