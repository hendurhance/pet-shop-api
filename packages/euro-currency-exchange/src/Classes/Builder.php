<?php

namespace Martian\EuroCurrencyExchange\Classes;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Martian\EuroCurrencyExchange\Http\Controllers\EuroCurrencyExchangeController;

class Builder
{
    /**
     * The exchange URL
     *
     * @var string
     */
    protected $url;

    /**
     * The cache ttl
     * 
     * @var int
     */
    protected $cache_ttl;

    /**
     * The cache base key
     * 
     * @var string
     */
    protected $cacheBaseKey;

    /**
     * The currencies
     * 
     * @var array
     */
    protected $currencies;

    /**
     * The default currency
     *
     * @var string
     */
    protected $defaultCurrency;

    /**
     * The default currency to convert to
     * 
     * @var string
     */
    protected $defaultCurrencyToConvertTo;

    /**
     * The default amount
     * 
     * @var float
     */
    protected $defaultAmount;

    /**
     * The default round to
     * 
     * @var int
     */
    protected $defaultRoundTo;

    /**
     * The default symbol
     * 
     * @var bool
     */
    protected $defaultSymbol;

    /**
     * The default symbol position
     * 
     * @var string
     */
    protected $defaultSymbolPosition;

    /**
     * The default exchange thousand separator
     * 
     * @var string
     */
    protected $defaultExchangeThousandSeparator;

    /**
     * The default exchange route
     * 
     * @var string
     */
    protected $defaultRoute;

    /**
     * The prefix
     * 
     * @var string
     */
    protected $prefix;

    /**
     * The middleware
     * 
     * @var array
     */
    protected $middleware;

    /**
     * Builder constructor.
     */
    public function __construct()
    {
        $this->url = config('euro-currency-exchange.url');
        $this->cache_ttl = config('euro-currency-exchange.cache_ttl');
        $this->currencies = config('euro-currency-exchange.currencies');
        $this->defaultCurrency = config('euro-currency-exchange.default');
        $this->defaultCurrencyToConvertTo = config('euro-currency-exchange.convert_to');
        $this->defaultAmount = config('euro-currency-exchange.amount');
        $this->defaultRoundTo = config('euro-currency-exchange.round');
        $this->defaultSymbol = config('euro-currency-exchange.symbol');
        $this->defaultSymbolPosition = config('euro-currency-exchange.symbol_position');
        $this->defaultExchangeThousandSeparator = config('euro-currency-exchange.exchange_thousand_separator');
        $this->defaultRoute = config('euro-currency-exchange.route');
        $this->cacheBaseKey = config('euro-currency-exchange.cache_base_key');
        $this->prefix = config('euro-currency-exchange.prefix');
        $this->middleware = config('euro-currency-exchange.middleware');
    }

    /**
     * Get the routes to handle the euro currency exchange
     * 
     * @return void
     */
    public function routes(): void
    {
        Route::middleware($this->middleware)->group(function () {
            Route::get(
                $this->prefix.'/'.$this->defaultRoute,
                EuroCurrencyExchangeController::class
            )->name($this->defaultRoute . '.invoke');
        });
    }

    /**
     * Get the URL
     * 
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Get the cache ttl
     * 
     * @return int
     */
    public function getCacheTtl(): int
    {
        return $this->cache_ttl;
    }

    /**
     * Get the currencies
     * 
     * @return array
     */
    public function getCurrencies(): array
    {
        return $this->currencies;
    }

    /**
     * Get the default currency
     * 
     * @return string
     */
    public function getDefaultCurrency(): string
    {
        return $this->defaultCurrency;
    }

    /**
     * Get the default currency to convert to
     * 
     * @return string
     */
    public function getDefaultCurrencyToConvertTo(): string
    {
        return $this->defaultCurrencyToConvertTo;
    }

    /**
     * Get the default amount
     * 
     * @return float
     */
    public function getDefaultAmount(): float
    {
        return $this->defaultAmount;
    }

    /**
     * Get the default round to
     * 
     * @return int
     */
    public function getDefaultRoundTo(): int
    {
        return $this->defaultRoundTo;
    }

    /**
     * Get the default symbol
     * 
     * @return bool
     */
    public function getDefaultSymbol(): bool
    {
        return $this->defaultSymbol;
    }

    /**
     * Get the default symbol position
     * 
     * @return string
     */

    public function getDefaultSymbolPosition(): string
    {
        return $this->defaultSymbolPosition;
    }

    /**
     * Cache has
     * 
     * @return bool
     */
    public function cacheHas($key)
    {
        return Cache::has($key);
    }

    /**
     * Get Cache
     * 
     * @return \Illuminate\Contracts\Cache\Repository
     */
    public function cacheGet($key)
    {
        return Cache::get($key);
    }

    /**
     * Put Cache
     * 
     * @return \Illuminate\Contracts\Cache\Repository
     */
    public function cachePut($key, $value)
    {
        return Cache::put($key, $value, $this->cache_ttl);
    }

    /**
     * Get the base cache key
     * 
     * @return string
     */
    public function getCacheBaseKey(): string
    {
        return $this->cacheBaseKey;
    }
}
