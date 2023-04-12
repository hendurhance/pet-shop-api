<?php

namespace App\Actions\Auth;

use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class AuthAction {
    use HttpResponse;

    /**
     * Constructor
     */
    public function __construct(protected string $guard) {}

    /**
     * Authenticate a user/admin and return a token.
     * @param array $data
     * @param string $guard
     * @return string
     */
    public function authenticate(array $data): string
    {
        $token = Auth::guard($this->guard)->attempt($data);
        if(!$token) $this->error('Invalid credentials', Response::HTTP_UNAUTHORIZED);
        return $token;
    }

    /**
     * Get authenticated user (admin/user)
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user(): \Illuminate\Contracts\Auth\Authenticatable|null
    {
        return Auth::guard($this->guard)->user();
    }
}