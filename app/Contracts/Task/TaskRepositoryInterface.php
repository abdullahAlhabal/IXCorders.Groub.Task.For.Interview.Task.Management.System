<?php

namespace App\Contracts\Task;

use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    public function getById(int $taskId): ?Task;
    public function getAll(): Collection;
    public function add(Task $task): void;
    public function update(Task $task): void;
    public function delete(Task $task): void;
    public function save(Task $task): void;
}
