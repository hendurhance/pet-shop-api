<?php

namespace App\Repositories\Admin\Auth;

use App\Actions\User\CreateUser;
use App\Contracts\Repositories\Admin\AuthenticateRepositoryInterface as AdminAuthenticateRepositoryInterface;
use App\Enums\UserTypeEnum;

class AuthenticateRepository implements AdminAuthenticateRepositoryInterface
{
    
    /**
     * @var CreateUser
     */
    private $createUser;

    /**
     * AuthenticateRepository constructor.
     * @param CreateUser $createUser
     */
    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;
    }

    public function login()
    {
        //
    }

    public function logout()
    {
        //
    }

    public function create(array $data)
    {
        return $this->createUser->execute($data, UserTypeEnum::IS_ADMIN);
    }
}