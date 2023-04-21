<?php

namespace Martian\EuroCurrencyExchange\Classes;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Martian\EuroCurrencyExchange\Classes\Builder;
use Martian\EuroCurrencyExchange\Contracts\EuroCurrencyExchangeInterface;
use Martian\EuroCurrencyExchange\Exceptions\EuroExchangeCurrencyException;
use Martian\EuroCurrencyExchange\Exceptions\ValidationException;

class EuroCurrencyExchange implements EuroCurrencyExchangeInterface
{
    /**
     * The amount
     *
     * @var float
     */
    protected $amount;

    /**
     * The currency converted to
     *
     * @var string
     */
    protected $to;

    /**
     * The builder instance
     *
     * @var \Martian\EuroCurrencyExchange\Classes\Builder
     */
    protected $builder;

    /**
     * The GuzzleHttp Client instance
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * ExchangeCurrencyExchange Class Construc  tor
     *
     * @param int $amount
     * @param string $to
     */
    public function __construct(float $amount, string $to)
    {
        $this->amount = $amount;
        $this->to = $to;
        $this->builder = new Builder();
        $this->client = new Client();
    }

    /**
     * Get the amount
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Get the currency converted to
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->builder->getDefaultCurrency();
    }

    /**
     * Get the rate
     *
     * @return float
     */
    public function getRate(): float
    {
        // Validate the currency
        if (!in_array($this->to, $this->builder->getCurrencies())) {
            throw new ValidationException('The currency {$this->to} is not supported.');
        }
        try {
            $cacheKey = $this->builder->getCacheBaseKey().'_'.$this->to;
            // check if the cache key exists
            if ($this->builder->cacheHas($cacheKey)) {
                return $this->builder->cacheGet($cacheKey);
            }
            $response = $this->client->request('GET', $this->builder->getUrl());
            $xml = simplexml_load_string($response->getBody()->getContents());
            $array = json_decode(json_encode($xml), true);
            $currencies = $array['Cube']['Cube']['Cube'];
            // loop through and check if the currency is in the array
            $rate = 0.00;
            foreach ($currencies as $currency) {
                if ($currency['@attributes']['currency'] === $this->to) {
                    $rate = $currency['@attributes']['rate'];
                }
            }
            // set the cache
            $this->builder->cachePut($cacheKey, $rate);
            return $rate;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new EuroExchangeCurrencyException('There was an error getting the exchange rate.');
        }
    }

    /**
     * Get the converted amount
     *
     * @return float
     */
    public function getConvertedAmount(): float
    {
        return round($this->amount * $this->getRate(), $this->builder->getDefaultRoundTo());
    }

    /**
     * Get the converted currency
     *
     * @return string
     */
    public function getConvertedCurrency(): string
    {
        return $this->to;
    }

    /**
     * Get the converted with symbol using default symbol position
     *
     * @return string
     */
    public function getConvertedAmountWithSymbol(): string
    {
        return $this->getConvertedAmountWithSymbolPosition();
    }

    /**
     * Get rounding
     *
     * @return int
     */
    public function getRounding(): int
    {
        return $this->builder->getDefaultRoundTo();
    }

    /**
     * Get the converted with symbol using the given symbol position
     *
     * @return string
     */
    public function getConvertedAmountWithSymbolPosition(): string
    {
        $symbol = $this->builder->getDefaultSymbol();
        if ($symbol) {
            $symbolPosition = $this->builder->getDefaultSymbolPosition();
            switch ($symbolPosition) {
                case 'before':
                    return $this->to .' '. $this->getConvertedAmount();
                case 'after':
                    return $this->getConvertedAmount() .' '. $this->to;
                default:
                    return $this->getConvertedAmount() .' '. $this->to;
            }
        }
    }
}
