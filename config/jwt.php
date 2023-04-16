<?php

/*
|--------------------------------------------------------------------------
| Authentication Defaults
|--------------------------------------------------------------------------
| This file contains the jwt authentication defaults.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Private & Public Keys
    |--------------------------------------------------------------------------
    | This secret is used by the JWT to sign your tokens. It is set in your
    | .env file and should be 32 characters or longer. It is recommended that
    | it is not a simple string or number, but instead a long, random string
    | of characters, numbers, and symbols.
    | 
    | This secret is used to sign the tokens when they are created and will
    | be used to verify the signature when the tokens are received.
    | 
    */

    'public_key' => env('JWT_PUBLIC_KEY'),

    'private_key' => env('JWT_PRIVATE_KEY'),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Algorithm
    |--------------------------------------------------------------------------
    | This algorithm is used by the JWT to sign your tokens. It is set in your
    | .env file and should be one of the following:
    |
    | HS256, HS384, HS512
    | RS256, RS384, RS512
    | ES256, ES384, EdDSA
    |
    | This algorithm is used to sign the tokens when they are created and will
    | be used to verify the signature when the tokens are received.
    |
    */

    'algo' => env('JWT_ALGO', 'EdDSA'),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Leeway
    |--------------------------------------------------------------------------
    | This leeway is used by the JWT to sign your tokens. It is set in your
    | .env file and should be an integer representing the number of seconds
    | that you would like to allow for a small drift of time between the
    | signing and verifying servers.
    |
    | This leeway is used to sign the tokens when they are created and will
    | be used to verify the signature when the tokens are received.
    |
    */

    'leeway' => env('JWT_LEEWAY', 0),

    /*
    | -----------------------------------------------------------------------
    | JWT Audience
    | -----------------------------------------------------------------------
    | This audience is used by the JWT to sign your tokens. It is set in your
    | .env file and should be a string representing the name of your application.
    |
    | This audience is used to sign the tokens when they are created and will
    | be used to verify the signature when the tokens are received.
    |
    */

    'audience' => env('JWT_AUDIENCE', 'localhost'),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Issuer
    |--------------------------------------------------------------------------
    | This issuer is used by the JWT to sign your tokens. It is set in your
    | .env file and should be a string representing the name of your application.
    |
    | This issuer is used to sign the tokens when they are created and will
    | be used to verify the signature when the tokens are received.
    |
    */

    'issuer' => env('JWT_ISSUER', 'localhost'),

    /*
    |--------------------------------------------------------------------------
    | JWT Time To Live
    |--------------------------------------------------------------------------
    | This ttl is used by the JWT to sign your tokens. It is set in your
    | .env file and should be an integer representing the number of minutes
    | that the token should be valid for.
    |
    | This ttl is used to sign the tokens when they are created and will
    | be used to verify the signature when the tokens are received.
    |
    */

    'ttl' => env('JWT_TTL', 60), // 1 hour

    /*
    |--------------------------------------------------------------------------
    | JWT Refresh Time To Live
    |--------------------------------------------------------------------------
    | This ttl is used by the JWT to sign your tokens. It is set in your
    | .env file and should be an integer representing the number of minutes
    | that the token should be valid for.
    |
    | This ttl is used to sign the tokens when they are created and will
    | be used to verify the signature when the tokens are received.
    |
    */

    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160), // 2 weeks

    /*
    |--------------------------------------------------------------------------
    | JWT Required Claims
    |--------------------------------------------------------------------------
    | This array of claims is used by the JWT to sign your tokens. It should be 
    | an array of strings representing the claims that must be present in the token.
    |
    | This array of claims is used to sign the tokens when they are created and will
    | be used to verify the signature when the tokens are received.
    |
    */

    'required_claims' => ['iss', 'iat', 'exp', 'nbf', 'sub', 'jti'],

];
