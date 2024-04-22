<?php

namespace App\Contracts\RecurringTask;

use App\Models\RecurringTask;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RecurringTaskServiceInterface
{
    public function getTaskById(int $taskId): ?RecurringTask;
    public function getAllTasks(): Collection;
    public function addTask(RecurringTask $task): void;
    public function updateTask(RecurringTask $task): void;
    public function deleteTask(RecurringTask $task): void;
    public function saveTask(RecurringTask $task): void;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;

}
