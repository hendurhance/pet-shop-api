<?php

namespace Martian\EuroCurrencyExchange\Tests\Unit\Http\Controllers;

use Martian\EuroCurrencyExchange\Http\Controllers\EuroCurrencyExchangeController;
use Martian\EuroCurrencyExchange\Tests\TestCase;

class EuroCurrencyExchangeControllerTest extends TestCase
{
    /**
     * Test the EuroCurrencyExchangeController class
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test the EuroCurrencyExchangeController class
     * 
     * @return void
     */
    public function test_euro_currency_exchange_controller_class()
    {
        $euroCurrencyExchangeController = new EuroCurrencyExchangeController();
        $this->assertInstanceOf(EuroCurrencyExchangeController::class, $euroCurrencyExchangeController);
    }

    /**
     * Test the EuroCurrencyExchangeController class returns a json response
     * 
     * @return void
     */
    public function test_euro_currency_exchange_controller_class_returns_json_response()
    {
        $request = request();
        $euroCurrencyExchangeController = new EuroCurrencyExchangeController();
        $response = $euroCurrencyExchangeController->__invoke($request);

        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }
}
