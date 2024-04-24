<?php

namespace App\Services;

use App\Contracts\Task\TaskRepositoryInterface;
use App\Contracts\Task\TaskServiceInterface;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TaskService implements TaskServiceInterface
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getTaskById(int $taskId): ?Task
    {
        return $this->taskRepository->getById($taskId);
    }
    public function getTaskWithComments(int $taskId): ?Task
    {
        return $this->taskRepository->getTaskWithComments($taskId);
    }
    public function getTaskWithAttachments(int $taskId): ?Task
    {
        return $this->taskRepository->getTaskWithAttachments($taskId);
    }
    public function getTaskWithCommentsAndAttachments(int $taskId): ?Task
    {
        return $this->taskRepository->getTaskWithCommentsAndAttachments($taskId);
    }
    public function getAllTasks(): Collection
    {
        return $this->taskRepository->getAll();
    }
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->taskRepository->paginate($perPage);
    }

    public function orderBy(string $column, string $direction = 'asc'): Collection
    {
        return $this->taskRepository->orderBy($column, $direction);
    }

    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator
    {
        return $this->taskRepository->paginateOrderedBy($column, $direction, $perPage);
    }
    public function getAllTasksPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->taskRepository->getAllTasksPaginated($perPage);
    }
    public function searchTasks(string $searchTerm, int $perPage = 10): LengthAwarePaginator
    {
        return $this->taskRepository->searchTasks($searchTerm, $perPage);
    }
    public function getAllTasksChunked(): void
    {
        Task::chunk(100, function ($tasks) {
            $tasks->load(['comments', 'attachments']);
        });
    }
    public function where(string $column, $value): Collection
    {
        return $this->taskRepository->where($column, $value);
    }

    public function addTask(Task $task): void
    {
        $this->taskRepository->add($task);
    }

    public function updateTask(Task $task): void
    {
        $this->taskRepository->update($task);
    }

    public function deleteTask(Task $task): void
    {
        $this->taskRepository->delete($task);
    }

    public function saveTask(Task $task): void
    {
        $this->taskRepository->save($task);
    }
}
