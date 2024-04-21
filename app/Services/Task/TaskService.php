<?php

namespace App\Services;

use App\Contracts\Task\TaskRepositoryInterface;
use App\Contracts\Task\TaskServiceInterface;
use App\Models\Task;
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

    public function getAllTasks(): Collection
    {
        return $this->taskRepository->getAll();
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
