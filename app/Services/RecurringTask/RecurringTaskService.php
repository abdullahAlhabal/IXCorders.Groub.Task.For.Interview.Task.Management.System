<?php

namespace App\Services;

use App\Contracts\RecurringTask\RecurringTaskRepositoryInterface;
use App\Contracts\RecurringTask\RecurringTaskServiceInterface;
use App\Models\RecurringTask;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RecurringTaskService implements RecurringTaskServiceInterface
{
    private RecurringTaskRepositoryInterface $recurringTaskRepository;

    public function __construct(RecurringTaskRepositoryInterface $recurringTaskRepository)
    {
        $this->recurringTaskRepository = $recurringTaskRepository;
    }

    public function getTaskById(int $taskId): ?RecurringTask
    {
        return $this->recurringTaskRepository->getById($taskId);
    }

    public function getAllTasks(): Collection
    {
        return $this->recurringTaskRepository->getAll();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->recurringTaskRepository->paginate($perPage);
    }

    public function orderBy(string $column, string $direction = 'asc'): Collection
    {
        return $this->recurringTaskRepository->orderBy($column, $direction);
    }

    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator
    {
        return $this->recurringTaskRepository->paginateOrderedBy($column, $direction, $perPage);
    }

    public function where(string $column, $value): Collection
    {
        return $this->recurringTaskRepository->where($column, $value);
    }
    public function addTask(RecurringTask $task): void
    {
        $this->recurringTaskRepository->add($task);
    }

    public function updateTask(RecurringTask $task): void
    {
        $this->recurringTaskRepository->update($task);
    }

    public function deleteTask(RecurringTask $task): void
    {
        $this->recurringTaskRepository->delete($task);
    }

    public function saveTask(RecurringTask $task): void
    {
        $this->recurringTaskRepository->save($task);
    }
}
