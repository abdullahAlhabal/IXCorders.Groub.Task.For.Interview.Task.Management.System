<?php

namespace App\Repositories;

use App\Contracts\RecurringTask\RecurringTaskRepositoryInterface;
use App\Models\RecurringTask;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RecurringTaskRepository implements RecurringTaskRepositoryInterface
{
    public function getById(int $taskId): ?RecurringTask
    {
        return RecurringTask::find($taskId);
    }

    public function getAll(): Collection
    {
        return RecurringTask::all();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return RecurringTask::paginate($perPage);
    }

    public function orderBy(string $column, string $direction = 'asc'): Collection
    {
        return RecurringTask::orderBy($column, $direction)->get();
    }

    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator
    {
        return RecurringTask::orderBy($column, $direction)->paginate($perPage);
    }

    public function where(string $column, $value): Collection
    {
        return RecurringTask::where($column, $value)->get();
    }

    public function add(RecurringTask $task): void
    {
        $task->save();
    }

    public function update(RecurringTask $task): void
    {
        $task->save();
    }

    public function delete(RecurringTask $task): void
    {
        $task->delete();
    }

    public function save(RecurringTask $task): void
    {
        $task->save();
    }
}
