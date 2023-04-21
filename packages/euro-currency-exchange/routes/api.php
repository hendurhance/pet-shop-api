<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Martian\EuroCurrencyExchange\Classes\Builder;

if (!config('euro-currency-exchange.route_disabled')) {
   (new Builder())->routes();
}