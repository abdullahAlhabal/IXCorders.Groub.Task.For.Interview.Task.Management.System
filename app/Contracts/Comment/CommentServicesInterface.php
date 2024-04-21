<?php

namespace App\Contracts\Comment;

use App\Models\Comment;
use Illuminate\Support\Collection;

interface CommentServiceInterface
{
    public function getCommentById(int $commentId): ?Comment;
    public function getAllComments(): Collection;
    public function addComment(Comment $comment): void;
    public function updateComment(Comment $comment): void;
    public function deleteComment(Comment $comment): void;
    public function saveComment(Comment $comment): void;
}
