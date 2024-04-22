<?php

namespace App\Contracts\TaskStatus;

use App\Models\TaskStatus;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TaskStatusRepositoryInterface
{
    public function getById(int $taskStatusId): ?TaskStatus;
    public function getAll(): Collection;
    public function add(TaskStatus $taskStatus): void;
    public function update(TaskStatus $taskStatus): void;
    public function delete(TaskStatus $taskStatus): void;
    public function save(TaskStatus $taskStatus): void;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;
}
