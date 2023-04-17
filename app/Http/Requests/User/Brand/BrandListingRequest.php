<?php

namespace App\Http\Requests\User\Brand;

use App\Http\Requests\BaseRequest;

class BrandListingRequest extends BaseRequest
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
        return array_merge(parent::rules(), [
            // additional rules specific to this request
        ]);
    }
}
