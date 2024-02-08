<?php

namespace App\Providers;

use App\Repositories\ChatRepository;
use App\Repositories\Interfaces\ChatRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {

        $this->app->bind(ChatRepositoryInterface::class, ChatRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // \Illuminate\Support\Facades\View::addLocation(resource_path('views/PDF'));
    }
}
