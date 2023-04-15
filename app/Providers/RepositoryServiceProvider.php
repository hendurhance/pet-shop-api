<?php

namespace App\Providers;

use App\Contracts\Repositories\Admin\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\Admin\UserRepositoryInterface;
use App\Contracts\Repositories\User\AuthenticateRepositoryInterface as AuthenticateUserRepositoryInterface;
use App\Contracts\Repositories\User\BlogRepositoryInterface;
use App\Contracts\Repositories\User\BrandRepositoryInterface;
use App\Contracts\Repositories\User\CategoryRepositoryInterface;
use App\Contracts\Repositories\User\FileRepositoryInterface;
use App\Contracts\Repositories\User\OrderRepositoryInterface;
use App\Contracts\Repositories\User\OrderStatusRepositoryInterface;
use App\Contracts\Repositories\User\PaymentRepositoryInterface;
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
use App\Repositories\User\Order\OrderRepository;
use App\Repositories\User\Order\OrderStatusRepository;
use App\Repositories\User\Payment\PaymentRepository;
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
        $interfaces = [
            AuthenticateRepositoryInterface::class => AuthenticateRepository::class,
            UserRepositoryInterface::class => UserRepository::class,
            AuthenticateUserRepositoryInterface::class => AuthenticateUserRepository::class,
            MainUserRepositoryInterface::class => MainUserRepository::class,
            FileRepositoryInterface::class => FileRepository::class,
            BrandRepositoryInterface::class => BrandRepository::class,
            PromotionRepositoryInterface::class => PromotionRepository::class,
            BlogRepositoryInterface::class => BlogRepository::class,
            CategoryRepositoryInterface::class => CategoryRepository::class,
            ProductRepositoryInterface::class => ProductRepository::class,
            OrderStatusRepositoryInterface::class => OrderStatusRepository::class,
            PaymentRepositoryInterface::class => PaymentRepository::class,
            OrderRepositoryInterface::class => OrderRepository::class,
        ];

        foreach ($interfaces as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}
