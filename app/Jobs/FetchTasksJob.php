<?php

namespace App\Jobs;

use App\Models\Task;
// use App\Contracts\Task\TaskServiceInterface;
use App\Services\TaskService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchTasksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected TaskService $taskService;
    /**
     * Create a new job instance.
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->taskService->getAllTasksChunked();
    }
}
