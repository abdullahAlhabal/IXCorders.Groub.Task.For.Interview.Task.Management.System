<?php

namespace App\Contracts\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    /**
     * Get a user by their ID.
     *
     * @param int $userId
     * @return User|null
     */
    public function getUserById(int $userId): ?User;

    /**
     * Get all users.
     *
     * @return Collection
     */
    public function getAllUsers(): Collection;

    /**
     * Add a new user.
     *
     * @param User $user
     * @return void
     */
    public function addUser(User $user): void;

    /**
     * Update an existing user.
     *
     * @param User $user
     * @return void
     */
    public function updateUser(User $user): void;

    /**
     * Delete a user.
     *
     * @param User $user
     * @return void
     */
    public function deleteUser(User $user): void;

    /**
     * Save changes to a user.
     *
     * @param User $user
     * @return void
     */
    public function saveUser(User $user): void;
    /**
     * Paginate users.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * Order users by a specific column.
     *
     * @param string $column
     * @param string $direction
     * @return Collection
     */
    public function orderBy(string $column, string $direction = 'asc'): Collection;

    /**
     * Paginate users ordered by a specific column.
     *
     * @param string $column
     * @param string $direction
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;

    /**
     * Get users where a specific column matches a value.
     *
     * @param string $column
     * @param mixed $value
     * @return Collection
     */
    public function where(string $column, $value): Collection;
}
