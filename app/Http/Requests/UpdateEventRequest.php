<?php

namespace App\Http\Requests;

class UpdateEventRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['max:255', function ($attribute, $value, $fail) {
                if ($this->has($attribute) && empty($value)) {
                    $fail('The ' . $attribute . ' field cannot be empty');
                }
            }],
            'description' => ['max:65535', function ($attribute, $value, $fail) {
                if ($this->has($attribute) && empty($value)) {
                    $fail('The ' . $attribute . ' field cannot be empty');
                }
            }],
            'date_time' => ['date', function ($attribute, $value, $fail) {
                if ($this->has($attribute) && empty($value)) {
                    $fail('The ' . $attribute . ' field cannot be empty');
                }
            }],
            'location' => ['max:255', function ($attribute, $value, $fail) {
                if ($this->has($attribute) && empty($value)) {
                    $fail('The ' . $attribute . ' field cannot be empty');
                }
            }],
            'capacity' => ['integer', 'between:1,255', function ($attribute, $value, $fail) {
                if ($this->has($attribute) && empty($value)) {
                    $fail('The ' . $attribute . ' field cannot be empty');
                }
            }],
        ];
    }
}
