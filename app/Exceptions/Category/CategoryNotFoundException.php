<?php

namespace App\Exceptions\Category;

use App\Traits\HttpResponse;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CategoryNotFoundException extends Exception
{
    //
    use HttpResponse;

    // exception can only user custom message
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_null($message)) {
            $message = 'Category not found';
        }

        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return $this->error($this->getMessage(), Response::HTTP_NOT_FOUND);
    }
}
