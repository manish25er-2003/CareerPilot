<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => ['required', 'string', 'max:100'],
            'difficulty' => ['required', 'in:Easy,Medium,Hard'],
            'category' => ['required', 'in:Technical,HR,Behavioural,Programming,Database,Framework-specific'],
            'answer' => ['nullable', 'string', 'max:5000'],
            'question_id' => ['nullable', 'integer', 'exists:interview_questions,id'],
        ];
    }
}
