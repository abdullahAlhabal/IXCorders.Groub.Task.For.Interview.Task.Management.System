<?php

namespace App\Contracts\RecurringTask;

use App\Models\RecurringTask;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface RecurringTaskRepositoryInterface
{
    public function getById(int $taskId): ?RecurringTask;
    public function getAll(): Collection;
    public function add(RecurringTask $task): void;
    public function update(RecurringTask $task): void;
    public function delete(RecurringTask $task): void;
    public function save(RecurringTask $task): void;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;
}
