<?php

namespace App\Services;

use App\Contracts\Comment\CommentRepositoryInterface;
use App\Contracts\Comment\CommentServiceInterface;
use App\Models\Comment;
use Illuminate\Support\Collection;

class CommentService implements CommentServiceInterface
{
    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getCommentById(int $commentId): ?Comment
    {
        return $this->commentRepository->getById($commentId);
    }

    public function getAllComments(): Collection
    {
        return $this->commentRepository->getAll();
    }

    public function addComment(Comment $comment): void
    {
        $this->commentRepository->add($comment);
    }

    public function updateComment(Comment $comment): void
    {
        $this->commentRepository->update($comment);
    }

    public function deleteComment(Comment $comment): void
    {
        $this->commentRepository->delete($comment);
    }

    public function saveComment(Comment $comment): void
    {
        $this->commentRepository->save($comment);
    }
}
