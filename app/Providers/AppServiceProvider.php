<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(TaskServiceProvider::class);
        $this->app->register(UserServiceProvider::class);
        $this->app->register(CommentServiceProvider::class);
        $this->app->register(AttachmentServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
