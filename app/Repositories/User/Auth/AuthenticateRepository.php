<?php

namespace App\Repositories\User\Auth;

use App\Actions\Auth\AuthAction;
use App\Actions\User\CreateUserAction;
use App\Contracts\Repositories\User\AuthenticateRepositoryInterface as AuthenticateUserRepositoryInterface;
use App\Enums\UserTypeEnum;
use App\Traits\HttpResponse;

class AuthenticateRepository implements AuthenticateUserRepositoryInterface
{
    use HttpResponse;

    /**
     * @var CreateUserAction
     */
    private $createUserAction;

    /**
     * @var AuthAction
     */
    private $authAction;

    /**
     * AuthenticateRepository constructor.
     * @param CreateUser $createUser
     */
    public function __construct(CreateUserAction $createUserAction)
    {
        $this->createUserAction = $createUserAction;
        $this->authAction = new AuthAction('api');
    }

    /**
     * Create a user
     * @param array $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        return $this->createUserAction->execute($data, UserTypeEnum::IS_USER);
    }

    /**
     * Login a user
     * @param array $data
     */
    public function login(array $data)
    {

    }

    /**
     * Logout a user
     * @return void
     */
    public function logout()
    {

    }

    /**
     * Forgot password a user
     * @param string $email
     */
    public function forgotPassword(string $email)
    {

    }

    /**
     * Reset password token]
     * @param string $token
     */
    public function resetPasswordToken(string $token)
    {

    }
}