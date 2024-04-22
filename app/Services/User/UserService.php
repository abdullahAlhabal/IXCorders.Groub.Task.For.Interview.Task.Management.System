<?php

namespace App\Services;

use App\Contracts\User\UserServiceInterface;
use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->userRepository->paginate($perPage);
    }

    public function orderBy(string $column, string $direction = 'asc'): Collection
    {
        return $this->userRepository->orderBy($column, $direction);
    }

    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator
    {
        return $this->userRepository->paginateOrderedBy($column, $direction, $perPage);
    }

    public function where(string $column, $value): Collection
    {
        return $this->userRepository->where($column, $value);
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
