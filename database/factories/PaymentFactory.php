<?php

namespace Database\Factories;

use App\Enums\PaymentTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentTypes = PaymentTypeEnum::toArray();
        $randomType = $this->faker->randomElement($paymentTypes);
        Log::info('Payment type: ' . $randomType);
        return [
            'type' => $randomType,
            'details' => $this->getDetails($randomType)
        ];
    }

    /**
     * Get the details for the payment.
     *
     * @param string $type
     * @return array<string, mixed>
     */
    private function getDetails(string $type): array
    {
        switch ($type) {
            case PaymentTypeEnum::CARD->value:
                return [
                    'details' => [
                        'holder_name' => $this->faker->name,
                        'number' => $this->faker->creditCardNumber,
                        'ccv' => $this->faker->randomNumber(3),
                        'expiration_date' => $this->faker->creditCardExpirationDateString,
                    ]
                ];
            case PaymentTypeEnum::BANK_TRANSFER->value:
                return [
                    'details' => [
                        'swift' => $this->faker->swiftBicNumber,
                        'iban' => $this->faker->iban('US'),
                        'name' => $this->faker->name,
                    ]
                ];
            case PaymentTypeEnum::CASH->value:
                return [
                    'details' => [
                        'first_name' => $this->faker->firstName,
                        'last_name' => $this->faker->lastName,
                        'address' => (string) $this->faker->address,
                    ]
                ];
            default:
                return [];
        }
    }
}
