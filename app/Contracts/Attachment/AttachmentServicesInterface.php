<?php

namespace App\Contracts\Attachment;

use App\Models\Attachment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface AttachmentServicesInterface
{
    public function getAttachmentById(int $attachmentId): ?Attachment;
    public function getAllAttachments(): Collection;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;
    public function addAttachment(Attachment $attachment): void;
    public function updateAttachment(Attachment $attachment): void;
    public function deleteAttachment(Attachment $attachment): void;
    public function saveAttachment(Attachment $attachment): void;
    public function getAttachmentByUserPaginated(int $userId, int $perPage = 10): LengthAwarePaginator;
}
