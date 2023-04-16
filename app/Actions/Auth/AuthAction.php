<?php

namespace App\Actions\Auth;

use App\Exceptions\Auth\UnauthorizedException;
use App\Models\User;
use App\Services\JWT\JwtBuilder;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthAction
{
    /**
     * Authenticate a user/admin and return a token.
     * @param array $data
     * @param string $guard
     * @return string
     */
    public function authenticate(array $data): string
    {
        $user = Auth::attempt($data);

        if (!$user) {
            throw new UnauthorizedException();
        }

        try {
            return $this->createJwtToken(User::where('email', $data['email'])->first());
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw new UnauthorizedException();
        }
    }

    /**
     * Get authenticated user (admin/user)
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user(): \Illuminate\Contracts\Auth\Authenticatable|null
    {
        return Auth::user();
    }

    /**
     * Create a JWT token.
     * @param $user
     * @return string
     */
    private function createJwtToken($user, CarbonInterface $ttl = null): string
    {
        $ttl = $ttl ?? now()->addMinutes(config('jwt.ttl'));

        return (new JwtBuilder())
            ->issuedBy(config('jwt.issuer'))
            ->audience(config('jwt.audience'))
            ->issuedAt(now()->timestamp)
            ->canOnlyBeUsedAfter(Carbon::now()->addSeconds(config('jwt.leeway')))
            ->expiresAt($ttl)
            ->relatedTo($user->id)
            ->withClaim('user_uuid', $user->uuid)
            ->getToken();
    }
}
