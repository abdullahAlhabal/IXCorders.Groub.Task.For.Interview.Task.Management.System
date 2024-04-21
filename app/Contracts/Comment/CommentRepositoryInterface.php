<?php

namespace App\Contracts\Comment;

use App\Models\Comment;
use Illuminate\Support\Collection;

interface CommentRepositoryInterface
{
    public function getById(int $commentId): ?Comment;
    public function getAll(): Collection;
    public function add(Comment $comment): void;
    public function update(Comment $comment): void;
    public function delete(Comment $comment): void;
    public function save(Comment $comment): void;
}
