<?php

namespace App\Actions\User;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Carbon\Carbon;

final class CreateUser
{
    /**
     * Create a new user.
     * @param array $data
     * @param UserTypeEnum<bool> $type
     * @return User
     */
    public function execute(array $data, UserTypeEnum $type): User
    {
        $user = new User();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->is_admin = $type;
        $user->email = $data['email'];
        $user->email_verified_at = Carbon::now();
        $user->password = $data['password'];
        $user->avatar = $data['avatar'];
        $user->phone_number = $data['phone'];
        $user->is_marketing = $data['marketing'];
        $user->save();

        return $user;
    }

    
}

