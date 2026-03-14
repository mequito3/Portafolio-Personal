<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'tags' => ['nullable', 'string', 'max:500'],
            'github_url' => ['nullable', 'string', 'max:500'],
            'demo_url' => ['nullable', 'string', 'max:500'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'is_active' => $this->boolean('is_active', true),
            'order' => (int) ($this->order ?? 0),
        ]);
    }
}
