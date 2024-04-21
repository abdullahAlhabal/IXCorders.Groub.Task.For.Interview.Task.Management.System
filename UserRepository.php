<?php

namespace App\Repositories;

use App\Contracts;
use App\Models\User;
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
