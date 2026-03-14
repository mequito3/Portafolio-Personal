<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company'     => ['required', 'string', 'max:200'],
            'position'    => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'start_date'  => ['required', 'date'],
            'end_date'    => ['nullable', 'date', 'after:start_date'],
            'is_current'  => ['boolean'],
            'order'       => ['integer', 'min:0'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_current' => $this->boolean('is_current'),
            'order' => (int) ($this->order ?? 0),
        ]);

        if ($this->is_current) {
            $this->merge(['end_date' => null]);
        }
    }
}
