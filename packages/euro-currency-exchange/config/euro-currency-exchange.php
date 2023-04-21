<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exchange URL
    |--------------------------------------------------------------------------
    |
    | This value is the base URL of the exchange API.
    |
    */

    'url' => 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml',

    /*
    |--------------------------------------------------------------------------
    | Exchange Cache TTL
    |--------------------------------------------------------------------------
    |
    | This value is the cache time in minutes.
    |
    */

    'cache_ttl' => 60, // 1 hour

    /*
    |--------------------------------------------------------------------------
    | Exchange Cache Base Key
    |--------------------------------------------------------------------------
    |
    | This value is the cache base key.
    |
    */

    'cache_base_key' => 'euro-currency-exchange',

    /*
    |--------------------------------------------------------------------------
    | Exchange Currencies
    |--------------------------------------------------------------------------
    |
    | This value is the currencies that you want to use.
    |
    */

    'currencies' => [
        'USD',
        'JPY',
        'BGN',
        'CZK',
        'DKK',
        'GBP',
        'HUF',
        'PLN',
        'RON',
        'SEK',
        'CHF',
        'ISK',
        'NOK',
        'TRY',
        'AUD',
        'BRL',
        'CAD',
        'CNY',
        'HKD',
        'IDR',
        'ILS',
        'INR',
        'KRW',
        'MXN',
        'MYR',
        'NZD',
        'PHP',
        'SGD',
        'THB',
        'ZAR',
    ],

    /*
    |--------------------------------------------------------------------------
    | Exchange Default Currency
    |--------------------------------------------------------------------------
    |
    | This value is the default currency.
    |
    */

    'default' => 'EUR',

    /*
    |--------------------------------------------------------------------------
    | Exchange Default Currency Convert To
    |--------------------------------------------------------------------------
    |
    | This value is the default currency convert to.
    |
    */

    'convert_to' => 'USD',

    /*
    |--------------------------------------------------------------------------
    | Exchange Default Amount
    |--------------------------------------------------------------------------
    |
    | This value is the default amount.
    |
    */

    'amount' => 1.00,

    /*
    |--------------------------------------------------------------------------
    | Exchange Default Round
    |--------------------------------------------------------------------------
    |
    | This value is the default round.
    |
    */

    'round' => 2,

    /*
    |--------------------------------------------------------------------------
    | Exchange Default Symbol
    |--------------------------------------------------------------------------
    |
    | This value is the default symbol.
    |
    */

    'symbol' => true,

    /*
    |--------------------------------------------------------------------------
    | Exchange Default Symbol Position
    |--------------------------------------------------------------------------
    |
    | This value is the default symbol position.
    |
    */

    'symbol_position' => 'before',

    /*
    |--------------------------------------------------------------------------
    | Exchange Default Route Disabled
    |--------------------------------------------------------------------------
    |
    | This value is the default route disabled.
    |
    */

    'route_disabled' => false,

    /*
    |--------------------------------------------------------------------------
    | Default Exchange Route
    |--------------------------------------------------------------------------
    |
    | This value is the default route.
    |
    */

    'route' => 'exchange',

    /*
    |--------------------------------------------------------------------------
    | Default Exchange Prefix
    |--------------------------------------------------------------------------
    |
    | This value is the default prefix.
    |
    */

    'prefix' => 'api',

    /*
    |--------------------------------------------------------------------------
    | Default Exchange Middleware
    |--------------------------------------------------------------------------
    |
    | This value is the default middleware.
    |
    */

    'middleware' => ['api'],
];
