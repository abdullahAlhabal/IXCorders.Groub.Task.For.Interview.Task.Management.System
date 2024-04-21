<?php

namespace App\Contracts\TaskStatus;

use App\Models\TaskStatus;
use Illuminate\Support\Collection;

interface TaskStatusRepositoryInterface
{
    public function getById(int $taskStatusId): ?TaskStatus;
    public function getAll(): Collection;
    public function add(TaskStatus $taskStatus): void;
    public function update(TaskStatus $taskStatus): void;
    public function delete(TaskStatus $taskStatus): void;
    public function save(TaskStatus $taskStatus): void;
}
