<?php

namespace App\Providers;

use App\Repositories\AdminTicketRepository;
use App\Repositories\AuthRepository;
use App\Repositories\Interfaces\AdminTicketRepositoryInterface;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\AdminTicketService;
use App\Services\AuthService;
use App\Services\Interfaces\AdminTicketServiceInterface;
use App\Services\Interfaces\AuthServiceInterface;
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
    }

    public function boot(): void
    {
        fake()->locale('ru_RU');
    }
}
