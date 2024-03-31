<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            "title"=> ["required", "string", "max:50", Rule::unique(table: "tasks", column: "title")->ignore(id: request("task"), idColumn: "id")],
            "description"=> ["required", "string", "max:400"],
            "status"=> ["required", "string", "max:20"],
            "content_uri"=> ["required", "string", "max:255"],
            "user_id"=> ["required", 'integer', 'exists:users,id'],
            "user_assigned"=> ["required", 'string'],
        ];
    }

    public function messages():array{
        return ["title.unique" => __("La tarea ya existe")];
        
    }
}
