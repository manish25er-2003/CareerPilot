<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AiAnalysisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resume_id' => ['required', 'integer', 'exists:resumes,id'],
            'job_title' => ['nullable', 'string', 'max:150'],
            'job_description' => ['nullable', 'string', 'min:20', 'max:4000'],
        ];
    }
}
