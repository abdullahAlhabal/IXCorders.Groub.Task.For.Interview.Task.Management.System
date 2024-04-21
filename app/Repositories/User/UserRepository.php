<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    private User $userModel; // Add type hint for User model

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getById(int $userId): ?User
    {
        return $this->userModel->find($userId);
    }

    public function getAll(): Collection
    {
        return $this->userModel->all();
    }
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->userModel->paginate($perPage);
    }

    public function orderBy(string $column, string $direction = 'asc'): Collection
    {
        return $this->userModel->orderBy($column, $direction)->get();
    }

    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator
    {
        return $this->userModel->orderBy($column, $direction)->paginate($perPage);
    }

    public function where(string $column, $value): Collection
    {
        return $this->userModel->where($column, $value)->get();
    }
    public function add(User $user): void
    {
        $user->save();
    }

    public function update(User $user): void
    {
        $user->save();
    }

    public function delete(User $user): void
    {
        $user->delete();
    }

    public function save(User $user): void
    {
        $user->save();
    }
}
