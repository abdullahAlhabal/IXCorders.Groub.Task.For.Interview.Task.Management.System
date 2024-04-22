<?php

namespace App\Contracts\Comment;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CommentRepositoryInterface
{
    public function getById(int $commentId): ?Comment;
    public function getAll(): Collection;
    public function add(Comment $comment): void;
    public function update(Comment $comment): void;
    public function delete(Comment $comment): void;
    public function save(Comment $comment): void;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;
}
