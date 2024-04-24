<?php

namespace App\Contracts\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getById(int $userId): ?User;
    public function getAll(): Collection;
    public function add(User $user): void;
    public function update(User $user): void;
    public function delete(User $user): void;
    public function save(User $user): void;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;
}
