<?php

namespace App\Services;

use App\Contracts\User\UserServiceInterface;
use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserById(int $userId): ?User
    {
        return $this->userRepository->getById($userId);
    }

    public function getAllUsers(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function addUser(User $user): void
    {
        $this->userRepository->add($user);
    }

    public function updateUser(User $user): void
    {
        $this->userRepository->update($user);
    }

    public function deleteUser(User $user): void
    {
        $this->userRepository->delete($user);
    }

    public function saveUser(User $user): void
    {
        $this->userRepository->save($user);
    }
}
