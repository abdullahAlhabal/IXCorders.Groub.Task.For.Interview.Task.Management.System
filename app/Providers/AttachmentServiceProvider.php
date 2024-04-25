<?php

namespace App\Providers;

use App\Contracts\Attachment\AttachmentRepositoryInterface;
use App\Contracts\Attachment\AttachmentServicesInterface;
use App\Repositories\AttachmentRepository;
use App\Services\AttachmentService;
use Illuminate\Support\ServiceProvider;

class AttachmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AttachmentRepositoryInterface::class, AttachmentRepository::class);
        $this->app->bind(AttachmentServicesInterface::class, AttachmentService::class);
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
