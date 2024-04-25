<?php

namespace App\Contracts\Comment;

use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CommentServiceInterface
{
    public function getCommentById(int $commentId): ?Comment;
    public function getAllComments(): Collection;public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;
    public function addComment(Comment $comment): void;
    public function updateComment(Comment $comment): void;
    public function deleteComment(Comment $comment): void;
    public function saveComment(Comment $comment): void;
    public function getAllCommentsPaginated(int $perPage = 10): LengthAwarePaginator;
    public function getAllCommentsByUserPaginated(int $userId, int $perPage = 10): LengthAwarePaginator;
}
