<?php

namespace App\Actions\Auth;

use App\Exceptions\Auth\UnauthorizedException;
use App\Models\JwtTokens;
use App\Models\User;
use App\Services\JWT\JwtBuilder;
use App\Services\JWT\JwtParser;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
     * Logout a user.
     * @return void
     */
    public function logout(): void
    {
        $identifyBy = (new JwtParser(request()->bearerToken()))->getIdentifiedBy();
        JwtTokens::where('unique_id', $identifyBy)->delete();
    }

    /**
     * Create a JWT token.
     * @param $user
     * @return string
     */
    private function createJwtToken($user, CarbonInterface $ttl = null): string
    {
        $ttl = $ttl ?? now()->addMinutes(config('jwt.ttl'));
        $identifyBy = base64_encode(Str::random(32).$user->uuid);
        // Create a JWT token
        (new CreateJwtTokenAction())->execute($user, $identifyBy, null, null, $ttl);

        return (new JwtBuilder())
            ->issuedBy(config('jwt.issuer'))
            ->audience(config('jwt.audience'))
            ->issuedAt(now()->timestamp)
            ->canOnlyBeUsedAfter(Carbon::now()->addSeconds(config('jwt.leeway')))
            ->expiresAt($ttl)
            ->relatedTo($user->id)
            ->withClaim('user_uuid', $user->uuid)
            ->identifiedBy($identifyBy)
            ->getToken();
    }
}
