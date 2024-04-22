<?php

namespace App\Contracts\Task;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    public function getById(int $taskId): ?Task;
    public function getAll(): Collection;
    public function add(Task $task): void;
    public function update(Task $task): void;
    public function delete(Task $task): void;
    public function save(Task $task): void;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;
}
