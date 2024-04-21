<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getById(int $userId): ?User;
    public function getAll(): Collection;
    public function add(User $user): void;
    public function update(User $user): void;
    public function delete(User $user): void;
    public function save(User $user): void;
}
