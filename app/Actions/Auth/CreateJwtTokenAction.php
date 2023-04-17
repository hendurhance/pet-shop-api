<?php

namespace App\Actions\Auth;

use App\Exceptions\Auth\UnauthorizedException;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Log;

class CreateJwtTokenAction
{
    /**
     * Execute the action.
     * @param User $user
     * @param string $unique_id
     * @param array|null $restrictions
     * @param array|null $permission
     * @param CarbonInterface $expire_at
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function execute(User $user, string $unique_id, array $restrictions = null, array $permission = null, CarbonInterface $expire_at)
    {
        try {
            return $user->jwtTokens()->create([
                'unique_id' => $unique_id,
                'expires_at' => Carbon::parse($expire_at),
                'token_title' => 'Token for ' . $user->uuid,
                'restrictions' => $restrictions,
                'permissions' => $permission,
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            throw new UnauthorizedException('Unable to create JWT token');
        }
    }
}
