<?php

namespace Martian\EuroCurrencyExchange\Contracts;

interface EuroCurrencyExchangeInterface
{
    /**
     * Get the amount
     * 
     * @return float
     */
    public function getAmount(): float;

    /**
     * Get currency
     * 
     * @return string
     */
    public function getCurrency(): string;

    /**
     * Get rate
     * 
     * @return float
     */
    public function getRate(): float;

    /**
     * Get the converted amount
     * 
     * @return float
     */
    public function getConvertedAmount(): float;

    /**
     * Get converted currency
     * 
     * @return string
     */
    public function getConvertedCurrency(): string;
}