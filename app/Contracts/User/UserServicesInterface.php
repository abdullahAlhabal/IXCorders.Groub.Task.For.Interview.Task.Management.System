<?php

namespace App\Contracts\User;

use App\Models\User;
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
}
