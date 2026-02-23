<?php

namespace App\Http\Requests;

use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;

class AdminEditUserRequest extends FormRequest
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
            'name' => 'required',
            'user_name' => 'required|unique:users,user_name,' . $this->user->id,
            'role' => 'required|in:admin,user',
            'status'=> 'required|in:' . implode(',', array_column(UserStatus::cases(), 'value')),
            'image' => 'nullable|mimes:jpeg,png,jpg',
            'date_of_birth' => 'required|date'
        ];
    }
}
