<?php

namespace App\Contracts\Task;

use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskServiceInterface
{
    public function getTaskById(int $taskId): ?Task;
    public function getAllTasks(): Collection;
    public function addTask(Task $task): void;
    public function updateTask(Task $task): void;
    public function deleteTask(Task $task): void;
    public function saveTask(Task $task): void;
}
