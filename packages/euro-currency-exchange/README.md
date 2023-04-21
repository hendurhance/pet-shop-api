# Euro Currency Exchange

[![Latest Version on Packagist](https://img.shields.io/packagist/v/martian/euro-currency-exchange.svg?style=flat-square)](https://packagist.org/packages/martian/euro-currency-exchange)
[![Total Downloads](https://img.shields.io/packagist/dt/martian/euro-currency-exchange.svg?style=flat-square)](https://packagist.org/packages/martian/euro-currency-exchange)
![GitHub Actions](https://github.com/hendurhance/euro-currency-exchange/actions/workflows/main.yml/badge.svg)

This package provides a simple way to get the current exchange rate of the Euro against other currencies.

## Installation

You can install the package via composer:

```bash
composer require martian/euro-currency-exchange
```

### Register Service Provider
You can register the service provider in the `config/app.php` file:

```php
// config/app.php

'providers' => [
    ...
    Martian\EuroCurrencyExchange\Providers\EuroCurrencyExchangeServiceProvider::class,
];
```

### Install Locally 
Open composer.json and add the following to the repositories section:
Note: You have to copy the package to the `packages/martian` directory.

```json
// composer.json

"require": {
    "martian/euro-currency-exchange": "@dev"
},

"repositories": [
    "local": {
        "type": "path",
        "url": "packages/martian/euro-currency-exchange",
        "options": {
            "symlink": true
        }
    }
]
```

Then run `composer update` to install the package.

### Publish Config
You can publish the config file with:
```bash
php artisan vendor:publish --provider="Martian\EuroCurrencyExchange\Providers\EuroCurrencyExchangeServiceProvider" --tag="config"
```

### Endpoint
The postman collection is available in the `postman` directory.

| Method | Endpoint | Query Parameters | Description |
| --- | --- | --- | --- |
| GET | /api/exchange | amount, to | Get the exchange rate of the Euro against other currencies. |

The swagger documentation is available at `/docs` folder. Open the `index.html` file in your browser.


## Usage

### Default Route (GET) [/api/exchange?amount=100&to=USD]
By default, the exchange endpoint is available at `/api/exchange`. You can change this by publishing the config file and changing the `route` key.

You might want to use `https://yourdomain.com/api/exchange?amount=100&to=USD` to get the exchange rate of 100 Euros to US Dollars.

### Custom Route
You can also use a custom route by publishing the config file and changing the `route` key.

```php
// config/euro-currency-exchange.php

return [
    'route' => 'your-custom-route',
];
```

### Custom Controller
You can also use the controller provided by this package by to create your own route. **Note: You need to set the `route_disabled` key to `true` in the config file to disable the default route, after publishing the config file.**

```php
// routes/api.php

use Martian\EuroCurrencyExchange\Http\Controllers\EuroCurrencyExchangeController;

Route::get('your-custom-route', EuroCurrencyExchangeController::class);
```

### Custom Response
You can also use the Builder provided by this package to create your own response from your controller.

```php
// app/Http/Controllers/YourCustomController.php

use Martian\EuroCurrencyExchange\Classes\Builder;

class YourCustomController extends Controller
{
    public function __invoke(Request $request)
    {
        $builder = new Builder($request->amount, $request->to);

        // Do something with the builder, check the provided methods in the Builder class.
        return response()->json([
            'amount' => $builder->getAmount(),
            'from' => $builder->getCurrency(),
            'to' => $builder->getConvertedCurrency(),
            'rate' => $builder->getRate(),
            'converted' => $builder->getConvertedAmount(),
        ]);
    }
}
```


### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email hendurhance.dev@gmail.com instead of using the issue tracker.

## Credits

-   [Josiah Endurance](https://github.com/martian)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

