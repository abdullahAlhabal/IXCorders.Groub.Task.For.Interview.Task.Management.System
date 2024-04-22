<?php

namespace App\Contracts\TaskStatus;

use App\Models\TaskStatus;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TaskStatusServicesInterface
{
    public function getStatusById(int $taskStatusId): ?TaskStatus;
    public function getAllStatus(): Collection;
    public function addStatus(TaskStatus $taskStatus): void;
    public function updateStatus(TaskStatus $taskStatus): void;
    public function deleteStatus(TaskStatus $taskStatus): void;
    public function saveStatus(TaskStatus $taskStatus): void;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;

}
