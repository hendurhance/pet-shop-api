<?php

namespace App\Providers;

use App\Contracts\Repositories\Admin\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\Admin\UserRepositoryInterface;
use App\Contracts\Repositories\User\AuthenticateRepositoryInterface as AuthenticateUserRepositoryInterface;
use App\Repositories\Admin\Auth\AuthenticateRepository;
use App\Repositories\Admin\User\UserRepository;
use App\Repositories\User\Auth\AuthenticateRepository as AuthenticateUserRepository;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register repositories in service container.
     *
     * @var void
     */
    public function register(): void
    {
        $this->app->bind(
            AuthenticateRepositoryInterface::class,
            AuthenticateRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            AuthenticateUserRepositoryInterface::class,
            AuthenticateUserRepository::class
        );
    }
}
