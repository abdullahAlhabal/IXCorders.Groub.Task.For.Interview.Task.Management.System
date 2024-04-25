<?php

namespace App\Contracts\Task;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    public function getById(int $taskId): ?Task;
    public function getTaskWithComments(int $taskId): ?Task;
    public function getTaskWithAttachments(int $taskId): ?Task;
    public function getTaskWithCommentsAndAttachments(int $taskId): ?Task;
    public function getAll(): Collection;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function getTasksPaginated(int $perPage = 10): LengthAwarePaginator;
    public function getCreatedTasksByUser(int $userId, int $perPage = 10): LengthAwarePaginator;
    public function getUserTasks(int $userId, int $perPage = 10): LengthAwarePaginator;
    public function searchUserCreatedTasks(int $userId, string $searchTerm, int $perPage = 10): LengthAwarePaginator;
    public function searchUserTasks(int $userId, string $searchTerm, int $perPage = 10): LengthAwarePaginator;
    public function searchTasksScout(string $searchTerm, int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;
    public function add(Task $task): void;
    public function update(Task $task): void;
    public function delete(Task $task): void;
    public function save(Task $task): void;
}
