<?php

namespace App\Providers;

use App\Contracts\Repositories\Admin\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\Admin\UserRepositoryInterface;
use App\Contracts\Repositories\User\AuthenticateRepositoryInterface as AuthenticateUserRepositoryInterface;
use App\Contracts\Repositories\User\BrandRepositoryInterface;
use App\Contracts\Repositories\User\FileRepositoryInterface;
use App\Contracts\Repositories\User\UserRepositoryInterface as MainUserRepositoryInterface;
use App\Repositories\Admin\Auth\AuthenticateRepository;
use App\Repositories\Admin\User\UserRepository;
use App\Repositories\User\Auth\AuthenticateRepository as AuthenticateUserRepository;
use App\Repositories\User\Brand\BrandRepository;
use App\Repositories\User\File\FileRepository;
use App\Repositories\User\User\UserRepository as MainUserRepository;
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

        $this->app->bind(
            MainUserRepositoryInterface::class,
            MainUserRepository::class
        );

        $this->app->bind(
            FileRepositoryInterface::class,
            FileRepository::class
        );

        $this->app->bind(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );
    }
}
