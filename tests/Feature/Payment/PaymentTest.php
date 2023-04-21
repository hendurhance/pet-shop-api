<?php

namespace Tests\Feature\Payment;

use App\Actions\Auth\AuthAction;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $jwtToken;

    private $payments;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->user()->create();
        $this->jwtToken = (new AuthAction())->authenticate([
            'email' => $this->user->email,
            'password' => 'password'
        ]);
        $this->payments = Payment::factory()->count(5)->create();
    }

    /**
     * Test create payment works with type credit card
     * @return void
     */
    public function test_create_payment_works_with_type_credit_card()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.payment.store'), [
            'type' => 'credit_card',
            'details' => [
                'holder_name' => 'John Doe',
                'number' => '4242424242424242',
                'ccv' => '123',
                'expire_date' => '12/26',
            ]
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJson([
            'data' => [
                'type' => 'credit_card',
                'details' => [
                    'holder_name' => 'John Doe',
                    'number' => '4242424242424242',
                    'ccv' => '123',
                    'expire_date' => '12/26',
                ]
            ]
        ]);
    }

    /**
     * Test create payment works with type bank transfer
     * @return void
     */
    public function test_create_payment_works_with_type_bank_transfer()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.payment.store'), [
            'type' => 'bank_transfer',
            'details' => [
                'swift' => 'BANKPHMM',
                'iban' => 'PH1234567890',
                'name' => 'John Doe',
            ]
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJson([
            'data' => [
                'type' => 'bank_transfer',
                'details' => [
                    'swift' => 'BANKPHMM',
                    'iban' => 'PH1234567890',
                    'name' => 'John Doe',
                ]
            ]
        ]);
    }

    /**
     * Test create payment works with type cash on delivery
     * @return void
     */
    public function test_create_payment_works_with_type_cash_on_delivery()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.payment.store'), [
            'type' => 'cash_on_delivery',
            'details' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'address' => '123 Main St.',
            ]
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJson([
            'data' => [
                'type' => 'cash_on_delivery',
                'details' => [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'address' => '123 Main St.',
                ]
            ]
        ]);
    }

    /**
     * Test create payment fails when type is missing
     * @return void
     */
    public function test_create_payment_fails_when_type_is_missing()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('POST', route('api.v1.payment.store'), [
            'details' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'address' => '123 Main St.',
            ]
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJson([
            'errors' => [
                'type' => [
                    'The type field is required.'
                ]
            ]
        ]);
    }

    /**
     * Test list all payments works
     * @return void
     */
    public function test_list_all_payments_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('GET', route('api.v1.payment.index'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'type' => $this->payments[0]->type,
            'details' => $this->payments[0]->details,
        ]);
    }

    /**
     * Test show payment works
     * @return void
     */
    public function test_show_payment_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('GET', route('api.v1.payment.show', $this->payments[0]->uuid));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'type' => $this->payments[0]->type,
            'details' => $this->payments[0]->details,
        ]);
    }

    /**
     * Test update payment works
     * @return void
     */
    public function test_update_payment_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('PUT', route('api.v1.payment.update', $this->payments[0]->uuid), [
            'type' => 'credit_card',
            'details' => [
                'holder_name' => 'John Doe',
                'number' => '4242424242424242',
                'ccv' => '123',
                'expire_date' => '12/26',
            ]
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'type' => 'credit_card',
            'details' => [
                'holder_name' => 'John Doe',
                'number' => '4242424242424242',
                'ccv' => '123',
                'expire_date' => '12/26',
            ]
        ]);
    }

    /**
     * Test delete payment works
     * @return void
     */
    public function test_delete_payment_works()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->jwtToken)->json('DELETE', route('api.v1.payment.destroy', $this->payments[0]->uuid));

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

}
