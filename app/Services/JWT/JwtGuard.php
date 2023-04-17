<?php

namespace App\Services\JWT;

use App\Models\JwtTokens;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JwtGuard implements Guard
{
    use GuardHelpers;

    /**
     * @var Request
     */
    private $request;

    private $lastAttempted;

    public function __construct(UserProvider $provider, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
    }

    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        return $this->user = $this->authenticateByToken();
    }

    public function validate(array $credentials = [])
    {
        if (!$credentials) {
            return false;
        }

        if ($this->provider->retrieveByCredentials($credentials)) {
            return true;
        }

        return false;
    }

    public function attempt(array $credentials = [], $login = true)
    {
        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);

        if ($this->hasValidCredentials($user, $credentials)) {
            $this->user = $user;
            return true;
        }

        return false;
    }

    public function authenticatedAccessToken($token)
    {
        return JwtParser::loadFromToken($token);
    }

    protected function authenticateByToken()
    {
        if (!empty($this->user)) {
            return $this->user;
        }

        $token = $this->getBearerToken();

        if (empty($token)) {
            return null;
        }

        try {
            $decoded = $this->authenticatedAccessToken($token);
            Log::info('tokenIsInvalidated: ' . $this->tokenIsInvalidated($decoded->getIdentifiedBy()));
            if (!$this->tokenIsInvalidated($decoded->getIdentifiedBy())) {
                return null;
            }
            
            if (!$decoded) {
                $user = null;
            } else {
                $user = $this->provider->retrieveById($decoded->getRelatedTo());
            }
        } catch (\Exception $exception) {
            logger($exception);
            $user = null;
        }

        return $user;
    }

    protected function getBearerToken()
    {
        return $this->request->bearerToken();
    }

    protected function hasValidCredentials($user, $credentials)
    {
        return $user !== null && $this->provider->validateCredentials($user, $credentials);
    }

    protected function tokenIsInvalidated(string $identifyBy): bool
    {
        return JwtTokens::where('unique_id', $identifyBy)->exists();
    }
}
