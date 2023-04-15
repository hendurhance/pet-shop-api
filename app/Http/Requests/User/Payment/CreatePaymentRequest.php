<?php

namespace App\Http\Requests\User\Payment;

use App\Enums\PaymentTypeEnum;
use App\Rules\ValidExpireDate;
use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
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
            'type' => 'required|string|in:' . PaymentTypeEnum::values(),
            'details' => 'required|array',
            
            'details.holder_name' => 'required_if:type,' . PaymentTypeEnum::CARD->value.'|string|max:255',
            'details.number' => 'required_if:type,' . PaymentTypeEnum::CARD->value.'|numeric',
            'details.ccv' => 'required_if:type,' . PaymentTypeEnum::CARD->value.'|numeric',
            'details.expire_date' => [
                'required_if:type,' . PaymentTypeEnum::CARD->value,
                new ValidExpireDate(),
            ],

            'details.first_name' => 'required_if:type,' . PaymentTypeEnum::CASH->value.'|string|max:255',
            'details.last_name' => 'required_if:type,' . PaymentTypeEnum::CASH->value.'|string|max:255',
            'details.address' => 'required_if:type,' . PaymentTypeEnum::CASH->value.'|string|max:255',

            'details.swift' => 'required_if:type,' . PaymentTypeEnum::BANK_TRANSFER->value.'|string|max:255',
            'details.iban' => 'required_if:type,' . PaymentTypeEnum::BANK_TRANSFER->value.'|string|max:255',
            'details.name' => 'required_if:type,' . PaymentTypeEnum::BANK_TRANSFER->value.'|string|max:255',
        ];
    }
}
