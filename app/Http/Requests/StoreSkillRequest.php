<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:100'],
            'category'  => ['required', 'string', 'in:' . implode(',', array_keys(\App\Models\Skill::$categories))],
            'level'     => ['required', 'integer', 'min:0', 'max:100'],
            'icon'      => ['nullable', 'string', 'max:200'],
            'order'     => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active', true),
            'order' => (int) ($this->order ?? 0),
        ]);
    }
}
