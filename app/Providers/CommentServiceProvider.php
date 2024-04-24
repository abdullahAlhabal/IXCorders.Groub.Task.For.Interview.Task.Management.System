<?php

namespace App\Providers;

use App\Contracts\Comment\CommentRepositoryInterface;
use App\Contracts\Comment\CommentServiceInterface;
use App\Repositories\CommentRepository;
use App\Services\CommentService;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // ... (Optional code for service bootstrapping)
    }
}
