<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected $errorBag = "log-in";

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
            'login' => "required",
            'password' => 'required|min:8'
        ];
    }

    public function messages(): array{

      return[
          'login.required' => "Username or Email Required",
          "password.required" => "Empty Password Field",
          "password.min" => "Password must be of length 8",
          ];

    }
}
