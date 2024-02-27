<?php

namespace App\Providers;

use App\Repositories\GroupOfMessagesRepository;
use App\Repositories\GroupOfMessagesRepositoryInterface;
use App\Repositories\MessagesRepository;
use App\Repositories\MessagesRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GroupOfMessagesRepositoryInterface::class, GroupOfMessagesRepository::class);
        $this->app->bind(MessagesRepositoryInterface::class, MessagesRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
