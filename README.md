# Pet Shop API [Backend Development Task](https://buckhill.atlassian.net/wiki/spaces/BR/blog/2022/07/22/1690435585)
This is a RestfulAPI for a pet shop solution to [development task](https://buckhill.atlassian.net/wiki/spaces/BR/blog/2022/07/22/1690435585) built with Laravel. The API has a swagger documentation which can be accessed at [http://localhost:8000/api/swagger](http://localhost:8000/api/swagger) after running the application.

## Specifications
- PHP 8.2
- Laravel 10.0
- Swagger 3.0 Documentation
- Feature or Unit Tests
- JWT Authentication (firebase/php-jwt)\
- Migration and Seeders
- Eloquent Relationships
- Custom Middleware
- PSR-12 Coding Standard
- PHP Insights of 80% or more

## Installation
- Clone the repository
```bash
git clone https://github.com/hendurhance/pet-shop-api
```
- Copy the .env.example file to .env and update the database credentials
```bash
cp .env.example .env
```
- Install the dependencies
```bash
composer install
```
- Generate the application key
```bash
php artisan key:generate
```
- Generate the JWT secret
```bash
php artisan jwt:generate
```
- Run the migrations and seeders
```bash
php artisan migrate --seed
```
- Run tests, if you want to run the tests, you need to create a database named `petshopapi_test` and update the database credentials in the `env.testing` file.
```bash
php artisan test
```
- Run the application
```bash
php artisan serve
```

## API Documentation
The API documentation can be accessed at [http://localhost:8000/api/swagger](http://localhost:8000/api/swagger) after running the application.

## Architecture
- Design Pattern: Repository Pattern
    - Repositories can be found in the `app/Repositories` directory.
    - The Controller uses the Interface of the Repository to interact with the data layer, which can be found in the `app/Contracts/Repositories` directory.
    - Some of the Repositories uses Action classes to perform some of the operations, which can be found in the `app/Actions` directory.
- Traits: 
    - The `app/Traits` directory contains some of the traits used in the application.
    - HttpResponse: This trait is used to return a standard response for the API on all the controllers.
    - Slugable: This trait is used to generate a slug for the models that uses it.
    - Uuids: This trait is used to generate a uuid for the models that uses it.
- Builders:
    - The `app/Builders` directory contains the Query Builder classes used in the application.
    - The Query Builder classes are used to build the query for the repositories.
    - The `app/Builders/BaseBuilder.php` class is the base class for all the Query Builder classes that has common methods used in the application.
- Enums:
    - The `app/Enums` directory contains the Enum classes used in the application.
    - The Enum classes are used to define the constants used in the application like `UserTypeEnum`, `OrderStatusEnum`, etc.
- Rules:
    - The `app/Rules` directory contains the custom validation rules used in the application.
    - The `ValidExpireDate` rule is used to validate the expiration date of the credit card.
- Services:
    - The `app/Services` directory contains the service classes used in the application.
    - The `app/Services/JWT` directory contains the JWT service class used to generate and validate the JWT token. This uses the `config/jwt.php` file to get the JWT needed configurations. This service class is used in the `app/Http/Middleware/JWTMiddleware.php` middleware and the `app/Actions/Auth/AuthAction.php` action class and other classes that needs to generate or validate the JWT token.
- Service Providers:
    - The `app/Providers/RepositoryServiceProvider.php` service provider is used to bind the repositories to the interfaces.
- Requests:
    - The `app/Http/Requests` directory contains the request classes used in the application.
    - Some request extends`app/Http/Requests/BaseRequest.php` class for some of the common validations.
- Dependency Injection:
    - Repository Interfaces are injected into the controllers using the `app/Providers/RepositoryServiceProvider.php` service provider.

## PHP Insights
The PHP Insights for the project is:
<img width="704" alt="image" src="https://user-images.githubusercontent.com/50846992/232543276-04cc4ac8-4cc7-41e2-863f-e49aba919f89.png">

``` bash
php artisan insights
```


### Thanks for reading.
