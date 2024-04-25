<?php

namespace App\Services;

use App\Contracts\Attachment\AttachmentRepositoryInterface;
use App\Contracts\Attachment\AttachmentServicesInterface;
use App\Models\Attachment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AttachmentService implements AttachmentServicesInterface
{
    private AttachmentRepositoryInterface $attachmentRepository;

    public function __construct(AttachmentRepositoryInterface $attachmentRepository)
    {
        $this->attachmentRepository = $attachmentRepository;
    }

    public function getAttachmentById(int $attachmentId): ?Attachment
    {
        return $this->attachmentRepository->getById($attachmentId);
    }

    public function getAllAttachments(): Collection
    {
        return $this->attachmentRepository->getAll();
    }
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->attachmentRepository->paginate($perPage);
    }

    public function orderBy(string $column, string $direction = 'asc'): Collection
    {
        return $this->attachmentRepository->orderBy($column, $direction);
    }

    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator
    {
        return $this->attachmentRepository->paginateOrderedBy($column, $direction, $perPage);
    }

    public function where(string $column, $value): Collection
    {
        return $this->attachmentRepository->where($column, $value);
    }
    public function addAttachment(Attachment $attachment): void
    {
        $this->attachmentRepository->add($attachment);
    }

    public function updateAttachment(Attachment $attachment): void
    {
        $this->attachmentRepository->update($attachment);
    }

    public function deleteAttachment(Attachment $attachment): void
    {
        $this->attachmentRepository->delete($attachment);
    }

    public function saveAttachment(Attachment $attachment): void
    {
        $this->attachmentRepository->save($attachment);
    }

    public function getAttachmentByUserPaginated(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->attachmentRepository->getAttachmentByUserPaginated($userId, $perPage);
    }

}
