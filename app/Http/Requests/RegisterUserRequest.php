<?php

namespace App\Http\Requests;

use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
     protected $errorBag = "register";

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole([ 'super-admin']) || !auth()->check();
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
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'user_name' => 'required|unique:users',
            'date_of_birth' => 'required|date',
            'role' => 'nullable|in:admin,user,super-admin,editor',
            'status' => 'nullable|in:' . implode(',', array_column(UserStatus::cases(), 'value')),
        ];
    }

    public function messages(): array{
          return [
             'name.required' => 'Name is required',
             'email.required' => "Email is requried",
             'password.confirmed' => 'Password Confirmation doesn\'t match.',
             'user_name.unique' => "Please Choose a Unique User-name",
             'date_of_birth.required' => 'Prefer an Avatar for you.'
          ];
    }
}
