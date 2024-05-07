<?php

namespace App\Http\Requests;

class StoreEventRequest extends BaseFormRequest
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
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:65535'],
            'date_time' => ['required', 'date'],
            'location' => ['required', 'max:255'],
            'capacity' => ['required', 'integer', 'between:1,255'],
        ];
    }
}
