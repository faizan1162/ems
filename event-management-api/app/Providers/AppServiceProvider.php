<?php

namespace App\Providers;

use App\Contracts\CustomAuthInterface;
use App\Contracts\DashboardInterface;
use App\Contracts\EventInterface;
use App\Contracts\TicketBookingInterface;
use App\Contracts\UserInterface;
use App\Services\CustomAuthService;
use App\Services\DashboardService;
use App\Services\EventService;
use App\Services\TicketBookingService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CustomAuthInterface::class, CustomAuthService::class);
        $this->app->bind(DashboardInterface::class, DashboardService::class);
        $this->app->bind(EventInterface::class, EventService::class);
        $this->app->bind(UserInterface::class, UserService::class);
        $this->app->bind(TicketBookingInterface::class, TicketBookingService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }
}
