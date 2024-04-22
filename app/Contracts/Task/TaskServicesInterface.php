<?php

namespace App\Contracts\Task;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TaskServiceInterface
{
    public function getTaskById(int $taskId): ?Task;
    public function getAllTasks(): Collection;
    public function addTask(Task $task): void;
    public function updateTask(Task $task): void;
    public function deleteTask(Task $task): void;
    public function saveTask(Task $task): void;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;

}
