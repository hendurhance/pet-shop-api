<?php

namespace App\Http\Requests\User\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryListingRequest extends FormRequest
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
        ];
    }
}
