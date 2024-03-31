<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name"=> ["required", "string", "max:50"],
            "email"=> ["required", "string",Rule::unique(table: "users", column: "email")->ignore(id: request("user"), idColumn: "id")],
            "role"=> ["required", "string"],
            "first_change_password"=> ["required", "boolean"],
            "password"=> ["required", 'string', "max:50"],
        ];
    }

    public function messages():array{
        return ["email.unique" => __("El email ya existe")];
        
    }
}
