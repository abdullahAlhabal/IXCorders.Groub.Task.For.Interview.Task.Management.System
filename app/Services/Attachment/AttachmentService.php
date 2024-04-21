<?php

namespace App\Services;

use App\Contracts\Attachment\AttachmentRepositoryInterface;
use App\Contracts\Attachment\AttachmentServicesInterface;
use App\Models\Attachment;
use Illuminate\Support\Collection;

class AttachmentServices implements AttachmentServicesInterface
{
    private AttachmentRepositoryInterface $attachmentRepository;

    public function __construct(AttachmentRepositoryInterface $attachmentRepository)
    {
        $this->attachmentRepository = $attachmentRepository;
    }

    public function getTaskById(int $attachmentId): ?Attachment
    {
        return $this->attachmentRepository->getById($attachmentId);
    }

    public function getAllTasks(): Collection
    {
        return $this->attachmentRepository->getAll();
    }

    public function addTask(Attachment $attachment): void
    {
        $this->attachmentRepository->add($attachment);
    }

    public function updateTask(Attachment $attachment): void
    {
        $this->attachmentRepository->update($attachment);
    }

    public function deleteTask(Attachment $attachment): void
    {
        $this->attachmentRepository->delete($attachment);
    }

    public function saveTask(Attachment $attachment): void
    {
        $this->attachmentRepository->save($attachment);
    }
}
