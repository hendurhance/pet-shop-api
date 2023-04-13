<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserListingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'page' => 'nullable|integer',
            'limit' => 'nullable|integer',
            'sortBy' => 'nullable|string',
            'desc' => 'nullable|boolean',
            'first_name' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'created_at' => 'nullable|string|date_format:Y-m-d',
            'marketing' => 'nullable|string',
        ];
    }
}
