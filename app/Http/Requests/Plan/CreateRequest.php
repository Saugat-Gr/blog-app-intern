<?php

namespace App\Http\Requests\Plan;

use App\Enums\PlanStatus;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => 'required|min:4',
            'description' => 'required',
            'price' => 'required|numeric|min:0',,
            'duration' => 'required|integer|min:1',,
            'stauts' => 'required|in:'. implode(',', array_column(PlanStatus::cases(), 'value')),
        ];
    }

      public function messages(): array
    {
        return [
            'name.required' => 'Plan name is required.',
            'description.required' => 'Plan description is required.',
            'price.required' => 'Plan price is required.',
            'duration.required' => 'Plan duration is required.',
            'status.required' => 'Plan status is required.',
        ];
    }
}
