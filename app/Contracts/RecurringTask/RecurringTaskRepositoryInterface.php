<?php

namespace App\Contracts\RecurringTask;

use App\Models\RecurringTask;
use Illuminate\Support\Collection;

interface RecurringTaskRepositoryInterface
{
    public function getById(int $taskId): ?RecurringTask;
    public function getAll(): Collection;
    public function add(RecurringTask $task): void;
    public function update(RecurringTask $task): void;
    public function delete(RecurringTask $task): void;
    public function save(RecurringTask $task): void;
}
