<?php

namespace App\Http\Requests\User\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'order_status_uuid' => 'required|uuid|exists:order_statuses,uuid',
            'payment_uuid' => 'required|uuid|exists:payments,uuid',

            'products' => 'required|array',
            'products.*.uuid' => 'required|uuid|exists:products,uuid',
            'products.*.quantity' => 'required|integer|min:1',

            'address' => 'required|array',
            'address.shipping' => 'required|string',
            'address.billing' => 'required|string',
        ];
    }
}
