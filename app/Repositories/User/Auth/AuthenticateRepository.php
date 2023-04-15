<?php

namespace App\Repositories\User\Auth;

use App\Actions\Auth\AuthAction;
use App\Actions\Auth\CreateResetTokenAction;
use App\Actions\User\CreateUserAction;
use App\Contracts\Repositories\User\AuthenticateRepositoryInterface as AuthenticateUserRepositoryInterface;
use App\Enums\UserTypeEnum;
use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use App\Traits\HttpResponse;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;

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
     * @var CreateResetTokenAction
     */
    private $createResetTokenAction;

    /**
     * AuthenticateRepository constructor.
     * @param CreateUser $createUser
     */
    public function __construct(CreateUserAction $createUserAction)
    {
        $this->createUserAction = $createUserAction;
        $this->authAction = new AuthAction();
        $this->createResetTokenAction = new CreateResetTokenAction();
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
        $token = $this->authAction->authenticate($data);
        $this->lastLoginAt($this->authAction->user());

        return [
            'token' => $token,
            'user' => $this->authAction->user(),
            'token_type' => 'jwt',
            'expires_in' => config('jwt.ttl') * 60
        ];
    }

    /**
     * Logout a user
     * @return void
     */
    public function logout()
    {
        Auth::logout();
    }

    /**
     * Forgot password a user
     * @param string $email
     */
    public function forgotPassword(string $email)
    {
        # We want to make sure that only users can reset their password
        $user = User::query()->whereUserType(UserTypeEnum::IS_USER)->whereEmailExact($email)->firstOr(function () {
            throw new UserNotFoundException();
        });

        return $this->createResetTokenAction->execute($user);
    }

    /**
     * Reset password token]
     * @param string $token
     */
    public function resetPasswordToken(array $data)
    {
        $user = $this->createResetTokenAction->findUserByToken($data['token'], $data['email']);

        $user->update([
            'password' => bcrypt($data['password'])
        ]);

        $this->createResetTokenAction->deleteResetToken($data['email']);
    }

    /**
     * Update last login at
     * @param User $user
     */
    public function lastLoginAt(User $user)
    {
        $user->update(['last_login_at' => Carbon::now()]);
    }
}
