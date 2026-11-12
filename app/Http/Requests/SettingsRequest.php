<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'theme' => ['nullable', 'in:light,dark'],
            'notification_email' => ['nullable', 'boolean'],
            'interview_reminders' => ['nullable', 'boolean'],
            'job_alerts' => ['nullable', 'boolean'],
            'timezone' => ['nullable', 'string', 'max:80'],
            'account_status' => ['nullable', 'in:active,inactive'],
        ];
    }
}
