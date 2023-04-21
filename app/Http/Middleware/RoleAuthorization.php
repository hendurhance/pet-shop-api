<?php

namespace App\Http\Middleware;

use App\Exceptions\Auth\UnauthorizedException;
use App\Traits\HttpResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();
        if (!$user) {
            throw new UnauthorizedException('Unauthorized');
        }

        foreach ($roles as $role) {
            if ($role === 'admin' && $user->is_admin) {
                return $next($request);
            }
            if ($role === 'user' && !$user->is_admin) {
                return $next($request);
            }
        }

        throw new UnauthorizedException('You are not authorized to access this resource');
    }
}
