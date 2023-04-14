<?php

namespace App\Exceptions\Product;

use App\Traits\HttpResponse;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ProductNotFoundException extends Exception
{
    //
    use HttpResponse;

    // exception can only user custom message
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_null($message)) {
            $message = 'Product not found';
        }

        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return $this->error($this->getMessage(), Response::HTTP_NOT_FOUND);
    }
}
