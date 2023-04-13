<?php

namespace App\Repositories\Admin\Auth;

use App\Actions\Auth\AuthAction;
use App\Actions\User\CreateUserAction;
use App\Contracts\Repositories\Admin\AuthenticateRepositoryInterface as AdminAuthenticateRepositoryInterface;
use App\Enums\UserTypeEnum;
use App\Models\User;
use App\Traits\HttpResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateRepository implements AdminAuthenticateRepositoryInterface
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
        $this->authAction = new AuthAction('admin');
    }

    /**
     * Login admin
     * @param array $data
     * @return array
     */
    public function login(array $data)
    {
        $token = $this->authAction->authenticate($data);
        $this->lastLoginAt($this->authAction->user());

        return [
            'token' => $token,
            'user' => Auth::guard('admin')->user(),
            'token_type' => 'jwt',
            'expires_in' => config('jwt.ttl') * 60
        ];
    }

    /**
     * Logout admin
     * @return void
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
    }

    /**
     * Create admin
     * @param array $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        return $this->createUserAction->execute($data, UserTypeEnum::IS_ADMIN);
    }
    
    /**
     * Update last login at
     * @param User $user
     */
    public function lastLoginAt(User $user){
        $user->update(['last_login_at' => Carbon::now()]);
    }
}