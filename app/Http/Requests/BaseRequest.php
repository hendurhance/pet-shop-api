<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
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
