<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'job_title',
        'job_url',
        'location',
        'salary_range',
        'job_type',
        'status',
        'applied_at',
        'interview_date',
        'notes',
    ];

    protected $casts = [
        'applied_at' => 'date',
        'interview_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
