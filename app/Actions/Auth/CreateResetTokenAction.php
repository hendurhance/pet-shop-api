<?php

namespace App\Actions\Auth;

use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateResetTokenAction
{
    /**
     * Create a reset token for a user
     *
     * @param  \App\Models\User  $user
     * @return string
     */
    public function execute(User $user): string
    {
        $token = Str::random(60);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now()]
        );
        return $token;
    }

    /**
     * Find a user by their reset token and email
     * 
     * @param  string  $token
     * @param  string  $email
     * @return \App\Models\User|null
     */
    public function findUserByToken(string $token, string $email): ?User
    {
        $user = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->where('email', $email)
            ->where('created_at', '>=', now()->subHours(24))
            ->first();

        return User::whereEmailExact($email)->firstOr(function () {
            throw new UserNotFoundException();
        });
    }
}
