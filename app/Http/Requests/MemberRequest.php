<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
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
        $memberId = $this->route("memberId");
        return [
            "name" => ["required", 'max:100'],
            "username" => ["required", "max:50", Rule::unique("users", "username")->ignore($memberId)],
            "email" => ["required", Rule::unique("users", "email")->ignore($memberId)],
            "profile_image" => ["file", "mimes:png,jpg", "max:10000"]
        ];
    }
}
