<?php

namespace App\Services;

use App\Contracts\RecurringTask\RecurringTaskRepositoryInterface;
use App\Contracts\RecurringTask\RecurringTaskServiceInterface;
use App\Models\RecurringTask;
use Illuminate\Support\Collection;

class RecurringTaskService implements RecurringTaskServiceInterface
{
    private RecurringTaskRepositoryInterface $taskRepository;

    public function __construct(RecurringTaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getTaskById(int $taskId): ?RecurringTask
    {
        return $this->taskRepository->getById($taskId);
    }

    public function getAllTasks(): Collection
    {
        return $this->taskRepository->getAll();
    }

    public function addTask(RecurringTask $task): void
    {
        $this->taskRepository->add($task);
    }

    public function updateTask(RecurringTask $task): void
    {
        $this->taskRepository->update($task);
    }

    public function deleteTask(RecurringTask $task): void
    {
        $this->taskRepository->delete($task);
    }

    public function saveTask(RecurringTask $task): void
    {
        $this->taskRepository->save($task);
    }
}
