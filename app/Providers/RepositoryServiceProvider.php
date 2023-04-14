<?php

namespace App\Providers;

use App\Contracts\Repositories\Admin\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\Admin\UserRepositoryInterface;
use App\Contracts\Repositories\User\AuthenticateRepositoryInterface as AuthenticateUserRepositoryInterface;
use App\Contracts\Repositories\User\BlogRepositoryInterface;
use App\Contracts\Repositories\User\BrandRepositoryInterface;
use App\Contracts\Repositories\User\CategoryRepositoryInterface;
use App\Contracts\Repositories\User\FileRepositoryInterface;
use App\Contracts\Repositories\User\ProductRepositoryInterface;
use App\Contracts\Repositories\User\PromotionRepositoryInterface;
use App\Contracts\Repositories\User\UserRepositoryInterface as MainUserRepositoryInterface;
use App\Repositories\Admin\Auth\AuthenticateRepository;
use App\Repositories\Admin\User\UserRepository;
use App\Repositories\User\Auth\AuthenticateRepository as AuthenticateUserRepository;
use App\Repositories\User\Blog\BlogRepository;
use App\Repositories\User\Brand\BrandRepository;
use App\Repositories\User\Category\CategoryRepository;
use App\Repositories\User\File\FileRepository;
use App\Repositories\User\Product\ProductRepository;
use App\Repositories\User\Promotion\PromotionRepository;
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

        $this->app->bind(
            PromotionRepositoryInterface::class,
            PromotionRepository::class
        );

        $this->app->bind(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
    }
}
