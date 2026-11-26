<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeBuilderDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:120'],
            'template' => ['required', 'in:modern,classic,executive,creative'],
            'theme_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'heading_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'personal_information' => ['required', 'array:name,job_title,email,phone,location,linkedin,portfolio,summary'],
            'personal_information.name' => ['nullable', 'string', 'max:200'],
            'personal_information.job_title' => ['nullable', 'string', 'max:200'],
            'personal_information.email' => ['nullable', 'email', 'max:254'],
            'personal_information.phone' => ['nullable', 'string', 'max:50'],
            'personal_information.location' => ['nullable', 'string', 'max:180'],
            'personal_information.linkedin' => ['nullable', 'url', 'max:2048'],
            'personal_information.portfolio' => ['nullable', 'url', 'max:2048'],
            'personal_information.summary' => ['nullable', 'string', 'max:5000'],
            'work_experience' => ['present', 'array', 'max:20'],
            'work_experience.*' => ['array:job_title,company,employment_type,location,start_date,end_date,current,responsibilities,achievements'],
            'work_experience.*.job_title' => ['nullable', 'string', 'max:200'],
            'work_experience.*.company' => ['nullable', 'string', 'max:200'],
            'work_experience.*.employment_type' => ['nullable', 'string', 'max:80'],
            'work_experience.*.location' => ['nullable', 'string', 'max:180'],
            'work_experience.*.start_date' => ['nullable', 'string', 'max:30'],
            'work_experience.*.end_date' => ['nullable', 'string', 'max:30'],
            'work_experience.*.current' => ['sometimes', 'boolean'],
            'work_experience.*.responsibilities' => ['nullable', 'string', 'max:6000'],
            'work_experience.*.achievements' => ['present', 'array', 'max:30'],
            'work_experience.*.achievements.*' => ['string', 'max:600'],
            'education' => ['present', 'array', 'max:20'],
            'education.*' => ['array:degree,institution,field,start_year,end_year,grade,description'],
            'education.*.degree' => ['nullable', 'string', 'max:200'],
            'education.*.institution' => ['nullable', 'string', 'max:200'],
            'education.*.field' => ['nullable', 'string', 'max:200'],
            'education.*.start_year' => ['nullable', 'string', 'max:20'],
            'education.*.end_year' => ['nullable', 'string', 'max:20'],
            'education.*.grade' => ['nullable', 'string', 'max:100'],
            'education.*.description' => ['nullable', 'string', 'max:3000'],
            'skills' => ['present', 'array', 'max:80'],
            'skills.*' => ['array:name,category,proficiency'],
            'skills.*.name' => ['nullable', 'string', 'max:120'],
            'skills.*.category' => ['nullable', 'string', 'max:120'],
            'skills.*.proficiency' => ['nullable', 'string', 'max:80'],
            'projects' => ['present', 'array', 'max:30'],
            'projects.*' => ['array:name,description,technologies,url,start_date,end_date'],
            'projects.*.name' => ['nullable', 'string', 'max:200'],
            'projects.*.description' => ['nullable', 'string', 'max:4000'],
            'projects.*.technologies' => ['nullable', 'string', 'max:500'],
            'projects.*.url' => ['nullable', 'url', 'max:2048'],
            'projects.*.start_date' => ['nullable', 'string', 'max:30'],
            'projects.*.end_date' => ['nullable', 'string', 'max:30'],
            'certifications' => ['present', 'array', 'max:30'],
            'certifications.*' => ['array:name,organization,issue_date,credential_url'],
            'certifications.*.name' => ['nullable', 'string', 'max:200'],
            'certifications.*.organization' => ['nullable', 'string', 'max:200'],
            'certifications.*.issue_date' => ['nullable', 'string', 'max:30'],
            'certifications.*.credential_url' => ['nullable', 'url', 'max:2048'],
            'languages' => ['present', 'array', 'max:30'],
            'languages.*' => ['array:name,proficiency'],
            'languages.*.name' => ['nullable', 'string', 'max:120'],
            'languages.*.proficiency' => ['nullable', 'string', 'max:80'],
            'additional_sections' => ['present', 'array', 'max:20'],
            'additional_sections.*' => ['array:type,title,content'],
            'additional_sections.*.type' => ['required', 'in:awards,volunteer,publications,interests,references,custom'],
            'additional_sections.*.title' => ['nullable', 'string', 'max:120'],
            'additional_sections.*.content' => ['nullable', 'string', 'max:10000'],
        ];
    }
}
