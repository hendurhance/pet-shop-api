<?php

namespace App\Exceptions\Auth;

use App\Traits\HttpResponse;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UnauthorizedException extends Exception
{
    use HttpResponse;

    // exception can only user custom message
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        if (is_null($message)) {
            $message = 'Invalid credentials';
        }

        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return $this->error($this->getMessage(), Response::HTTP_UNAUTHORIZED);
    }
}
