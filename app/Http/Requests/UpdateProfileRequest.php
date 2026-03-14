<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],
            'job_title' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'logo_dark' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'favicon' => ['nullable', 'file', 'mimes:ico,png,jpg,jpeg,svg,webp', 'max:2048'],
            'github_url' => ['nullable', 'string', 'max:500'],
            'linkedin_url' => ['nullable', 'string', 'max:500'],
            'twitter_url' => ['nullable', 'string', 'max:500'],
            'stack_backend' => ['nullable', 'string', 'max:100'],
            'stack_frontend' => ['nullable', 'string', 'max:100'],
            'stack_database' => ['nullable', 'string', 'max:100'],
            'stack_devops' => ['nullable', 'string', 'max:100'],
            'years_experience' => ['nullable', 'integer', 'min:0', 'max:100'],
            'clients_count' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'years_experience' => (int) ($this->years_experience ?? 0),
            'clients_count' => (int) ($this->clients_count ?? 0),
        ]);
    }
}
