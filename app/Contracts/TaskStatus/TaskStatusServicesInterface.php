<?php

namespace App\Contracts\TaskStatus;

use App\Models\TaskStatus;
use Illuminate\Support\Collection;

interface TaskStatusServicesInterface
{
    public function getTaskById(int $taskStatusId): ?TaskStatus;
    public function getAllTasks(): Collection;
    public function addTask(TaskStatus $taskStatus): void;
    public function updateTask(TaskStatus $taskStatus): void;
    public function deleteTask(TaskStatus $taskStatus): void;
    public function saveTask(TaskStatus $taskStatus): void;
}
