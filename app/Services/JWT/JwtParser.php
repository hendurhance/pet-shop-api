<?php

namespace App\Services\JWT;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtParser
{
    /**
     * @var array|object
     */
    protected $claims;

    public function __construct(string $token)
    {
        JWT::$leeway = $this->getLeeway();
        $this->claims = JWT::decode($token, new Key($this->getPublicKey(), $this->getAlgo()));
    }

    public static function loadFromToken(string $token)
    {
        return new self($token);
    }

    public function getIssuedBy()
    {
        return $this->getClaim('iss');
    }

    public function getIssuedAt()
    {
        return $this->getClaim('iat');
    }

    public function getRelatedTo()
    {
        return $this->getClaim('sub');
    }

    public function getAudience()
    {
        return $this->getClaim('aud');
    }

    public function getExpiresAt()
    {
        return $this->getClaim('exp');
    }

    public function getIdentifiedBy()
    {
        return $this->getClaim('jti');
    }

    public function getCanOnlyBeUsedAfter()
    {
        return $this->getClaim('nbf');
    }

    protected function getClaim(string $name)
    {
        return $this->claims->{$name} ?? null;
    }

    protected function getPublicKey(): string
    {
        return config('jwt.public_key');
    }

    protected function getAlgo()
    {
        return config('jwt.algo');
    }

    protected function getLeeway()
    {
        return config('jwt.leeway');
    }
}
