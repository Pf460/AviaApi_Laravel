<?php

namespace App\Providers;

use App\Repositories\AdminTicketRepository;
use App\Repositories\AuthRepository;
use App\Repositories\CartRepository;
use App\Repositories\Interfaces\AdminTicketRepositoryInterface;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Services\AdminTicketService;
use App\Services\AuthService;
use App\Services\CartService;
use App\Services\Interfaces\AdminTicketServiceInterface;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\CartServiceInterface;
use App\Services\Interfaces\OrderServiceInterface;
use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //Сервисы и репозитории аутентификации
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);

        //Сервисы и репозитории админки
        $this->app->bind(AdminTicketRepositoryInterface::class, AdminTicketRepository::class);
        $this->app->bind(AdminTicketServiceInterface::class, AdminTicketService::class);

        //Ceрвисы и репозитории для корзины
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(CartServiceInterface::class, CartService::class);

        //Сервисы и репозитории для заказов
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
    }

    public function boot(): void
    {
        fake()->locale('ru_RU');
    }
}
