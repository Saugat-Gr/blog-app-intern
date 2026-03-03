<?php

namespace App\Http\Requests\Plan;

use App\Enums\PlanStatus;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|unique:plans,name,' . $this->plan->id,
            'description' => 'required',
            'status' => 'required|in:' . implode(',', array_column(PlanStatus::cases(), 'value')),
            'price' => 'required|numeric|min:100',
            'duration_days' => 'required|integer|min:1',
        ];
    }
}
