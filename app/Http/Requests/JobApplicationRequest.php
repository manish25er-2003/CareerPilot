<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:150'],
            'job_title' => ['required', 'string', 'max:150'],
            'job_url' => ['nullable', 'url', 'max:255'],
            'location' => ['nullable', 'string', 'max:150'],
            'salary_range' => ['nullable', 'string', 'max:80'],
            'job_type' => ['nullable', 'string', 'max:80'],
            'status' => ['nullable', 'in:Saved,Applied,Shortlisted,Interviewing,Offered,Rejected'],
            'applied_at' => ['nullable', 'date'],
            'interview_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
