<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResumeBuilderDocument extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'template',
        'theme_color',
        'heading_color',
        'personal_information',
        'work_experience',
        'education',
        'skills',
        'projects',
        'certifications',
        'languages',
        'additional_sections',
        'profile_photo_path',
    ];

    protected function casts(): array
    {
        return [
            'personal_information' => 'array',
            'work_experience' => 'array',
            'education' => 'array',
            'skills' => 'array',
            'projects' => 'array',
            'certifications' => 'array',
            'languages' => 'array',
            'additional_sections' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
