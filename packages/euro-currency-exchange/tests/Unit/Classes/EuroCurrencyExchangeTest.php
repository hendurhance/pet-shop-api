<?php

namespace Martian\EuroCurrencyExchange\Tests\Unit\Classes;

use Martian\EuroCurrencyExchange\Classes\EuroCurrencyExchange;
use Martian\EuroCurrencyExchange\Tests\TestCase;

class EuroCurrencyExchangeTest extends TestCase
{
    /**
     * Test the EuroCurrencyExchange class
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test the EuroCurrencyExchange class
     * 
     * @return void
     */
    public function test_euro_currency_exchange_class()
    {
        $euroCurrencyExchange = new EuroCurrencyExchange(100, 'USD');
        $this->assertInstanceOf(EuroCurrencyExchange::class, $euroCurrencyExchange);
    }

    /**
     * Test the EuroCurrencyExchange class returns the correct amount
     * 
     * @return void
     */
    public function test_euro_currency_exchange_class_returns_correct_amount()
    {
        $euroCurrencyExchange = new EuroCurrencyExchange(100, 'USD');
        $this->assertEquals(100, $euroCurrencyExchange->getAmount());
    }

    /**
     * Test the EuroCurrencyExchange class returns the correct currency
     * 
     * @return void
     */
    public function test_euro_currency_exchange_class_returns_correct_currency()
    {
        $euroCurrencyExchange = new EuroCurrencyExchange(100, 'USD');
        $this->assertEquals('USD', $euroCurrencyExchange->getConvertedCurrency());
    }

    /**
     * Test the EuroCurrencyExchange class returns the correct rounding
     * 
     * @return void
     */
    public function test_euro_currency_exchange_class_returns_correct_rounding()
    {
        $euroCurrencyExchange = new EuroCurrencyExchange(100, 'USD');
        $this->assertEquals(2, $euroCurrencyExchange->getRounding());
    }
}