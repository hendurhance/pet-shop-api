<?php

namespace Martian\EuroCurrencyExchange\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Martian\EuroCurrencyExchange\Classes\Builder;
use Martian\EuroCurrencyExchange\Classes\EuroCurrencyExchange;

class EuroCurrencyExchangeController extends Controller
{
    /**
     * The builder instance
     * @var \Martian\EuroCurrencyExchange\Classes\Builder
     */
    protected $builder;

    /**
     * The Controller constructor
     */
    public function __construct()
    {
        $this->builder = new Builder();
    }

    /**
     * Exchange the amount to the given currency. If the default route is enabled
     * then the route will be /api/exchange?amount=100&to=USD but if the default
     * route is disabled then the route will need to set the route yourself by 
     * using the controller method.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $amount = $request->get('amount', $this->builder->getDefaultAmount());
        $to = $request->get('to', $this->builder->getDefaultCurrencyToConvertTo());

        $exchange = new EuroCurrencyExchange($amount, $to);

        return response()->json([
            'amount' => $exchange->getAmount(),
            'from_currency' => $exchange->getCurrency(),
            'to_currency' => $exchange->getConvertedCurrency(),
            'rate' => $exchange->getRate(),
            'converted_amount' => $exchange->getConvertedAmount(),
            'converted_amount_symbol' => $exchange->getConvertedAmountWithSymbolPosition(),
        ]);
    }
}
