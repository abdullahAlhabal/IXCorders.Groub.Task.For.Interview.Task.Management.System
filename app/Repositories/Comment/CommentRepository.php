<?php

namespace App\Repositories;

use App\Contracts\Comment\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CommentRepository implements CommentRepositoryInterface
{
    public function getById(int $commentId): ?Comment
    {
        return Comment::find($commentId);
    }

    public function getAll(): Collection
    {
        return Comment::all();
    }
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Comment::paginate($perPage);
    }

    public function orderBy(string $column, string $direction = 'asc'): Collection
    {
        return Comment::orderBy($column, $direction)->get();
    }

    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator
    {
        return Comment::orderBy($column, $direction)->paginate($perPage);
    }

    public function where(string $column, $value): Collection
    {
        return Comment::where($column, $value)->get();
    }
    public function add(Comment $comment): void
    {
        $comment->save();
    }

    public function update(Comment $comment): void
    {
        $comment->save();
    }

    public function delete(Comment $comment): void
    {
        $comment->delete();
    }

    public function save(Comment $comment): void
    {
        $comment->save();
    }
}
