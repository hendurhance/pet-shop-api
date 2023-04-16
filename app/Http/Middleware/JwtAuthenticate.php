<?php

namespace App\Http\Middleware;

use App\Exceptions\Auth\UnauthorizedException;
use App\Services\JWT\JwtGuard;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class JwtAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = (new JwtGuard(Auth::createUserProvider('users'), $request))->user();

            if (empty($user)) {
                throw new UnauthorizedException();
            }

            Auth::setUser($user);

            return $next($request);
        } catch (\Exception $e) {
            throw new UnauthorizedException();
        }
    }
}