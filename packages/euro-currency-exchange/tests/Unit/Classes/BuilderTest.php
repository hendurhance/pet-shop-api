<?php

namespace Martian\EuroCurrencyExchange\Tests\Unit\Classes;

use Martian\EuroCurrencyExchange\Tests\TestCase;
use Martian\EuroCurrencyExchange\Classes\Builder;
use Illuminate\Support\Facades\Config;

class BuilderTest extends TestCase
{
    /**
     * Test the Builder class
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test the Builder class
     * 
     * @return void
     */
    public function test_builder_class()
    {
        $builder = new Builder();
        $this->assertInstanceOf(Builder::class, $builder);
    }

    /**
     * Test the Builder class
     * 
     * @return void
     */
    public function test_builder_class_with_config()
    {
        $builder = new Builder();
        $this->assertInstanceOf(Builder::class, $builder);
        $this->assertEquals(Config::get('euro-currency-exchange.url'), $builder->getUrl());
        $this->assertEquals(Config::get('euro-currency-exchange.cache_ttl'), $builder->getCacheTtl());
        $this->assertEquals(Config::get('euro-currency-exchange.cache_base_key'), $builder->getCacheBaseKey());
        $this->assertEquals(Config::get('euro-currency-exchange.currencies'), $builder->getCurrencies());
    }
}