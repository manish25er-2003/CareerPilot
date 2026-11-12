<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'theme',
        'notification_email',
        'interview_reminders',
        'job_alerts',
        'timezone',
        'account_status',
    ];

    protected $casts = [
        'notification_email' => 'boolean',
        'interview_reminders' => 'boolean',
        'job_alerts' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
