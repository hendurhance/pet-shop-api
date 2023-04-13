<?php

namespace App\Actions\Auth;

use App\Exceptions\Auth\UnauthorizedException;
use Illuminate\Support\Facades\Auth;

final class AuthAction {

    /**
     * Authenticate a user/admin and return a token.
     * @param array $data
     * @param string $guard
     * @return string
     */
    public function authenticate(array $data): string
    {
        $token = Auth::attempt($data);
        if(!$token) throw new UnauthorizedException();
        return $token;
    }

    /**
     * Get authenticated user (admin/user)
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user(): \Illuminate\Contracts\Auth\Authenticatable|null
    {
        return Auth::guard()->user();
    }
}