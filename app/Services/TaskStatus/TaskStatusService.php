<?php

namespace App\Services;

use App\Contracts\TaskStatus\TaskStatusRepositoryInterface;
use App\Contracts\TaskStatus\TaskStatusServicesInterface;
use App\Models\TaskStatus;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TaskStatusService implements TaskStatusServicesInterface
{
    private TaskStatusRepositoryInterface $taskStatusRepository;

    public function __construct(TaskStatusRepositoryInterface $taskStatusRepository)
    {
        $this->taskStatusRepository = $taskStatusRepository;
    }

    public function getTaskById(int $taskId): ?TaskStatus
    {
        return $this->taskStatusRepository->getById($taskId);
    }

    public function getAllTasks(): Collection
    {
        return $this->taskStatusRepository->getAll();
    }
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->taskStatusRepository->paginate($perPage);
    }

    public function orderBy(string $column, string $direction = 'asc'): Collection
    {
        return $this->taskStatusRepository->orderBy($column, $direction);
    }

    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator
    {
        return $this->taskStatusRepository->paginateOrderedBy($column, $direction, $perPage);
    }

    public function where(string $column, $value): Collection
    {
        return $this->taskStatusRepository->where($column, $value);
    }

    public function addTask(TaskStatus $task): void
    {
        $this->taskStatusRepository->add($task);
    }

    public function updateTask(TaskStatus $task): void
    {
        $this->taskStatusRepository->update($task);
    }

    public function deleteTask(TaskStatus $task): void
    {
        $this->taskStatusRepository->delete($task);
    }

    public function saveTask(TaskStatus $task): void
    {
        $this->taskStatusRepository->save($task);
    }
}
