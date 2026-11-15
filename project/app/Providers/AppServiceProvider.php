<?php

namespace App\Providers;

use App\Repositories\AdminproductRepository;
use App\Repositories\AuthRepository;
use App\Repositories\CartRepository;
use App\Repositories\Interfaces\AdminproductRepositoryInterface;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Services\AdminproductService;
use App\Services\AuthService;
use App\Services\CartService;
use App\Services\Interfaces\AdminproductServiceInterface;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\CartServiceInterface;
use App\Services\Interfaces\OrderServiceInterface;
use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        fake()->locale('ru_RU');
    }
}
