<?php

namespace App\Contracts\RecurringTask;

use App\Models\RecurringTask;
use Illuminate\Support\Collection;

interface RecurringTaskServiceInterface
{
    public function getTaskById(int $taskId): ?RecurringTask;
    public function getAllTasks(): Collection;
    public function addTask(RecurringTask $task): void;
    public function updateTask(RecurringTask $task): void;
    public function deleteTask(RecurringTask $task): void;
    public function saveTask(RecurringTask $task): void;
}
