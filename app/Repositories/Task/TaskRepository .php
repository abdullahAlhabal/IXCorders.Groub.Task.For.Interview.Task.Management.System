<?php

namespace App\Repositories;

use App\Contracts\Task\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function getById(int $taskId): ?Task
    {
        return Task::find($taskId);
    }

    public function getAll(): Collection
    {
        return Task::all();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Task::paginate($perPage);
    }

    public function orderBy(string $column, string $direction = 'asc'): Collection
    {
        return Task::orderBy($column, $direction)->get();
    }

    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator
    {
        return Task::orderBy($column, $direction)->paginate($perPage);
    }

    public function where(string $column, $value): Collection
    {
        return Task::where($column, $value)->get();
    }
    public function add(Task $task): void
    {
        $task->save();
    }

    public function update(Task $task): void
    {
        $task->save();
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }

    public function save(Task $task): void
    {
        $task->save();
    }
}
