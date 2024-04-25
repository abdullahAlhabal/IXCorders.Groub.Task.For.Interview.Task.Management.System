<?php

namespace App\Contracts\Attachment;

use App\Models\Attachment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface AttachmentRepositoryInterface
{
    public function getById(int $attachmentId): ?Attachment;
    public function getAll(): Collection;
    public function add(Attachment $attachment): void;
    public function update(Attachment $attachment): void;
    public function delete(Attachment $attachment): void;
    public function save(Attachment $attachment): void;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function orderBy(string $column, string $direction = 'asc'): Collection;
    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator;
    public function where(string $column, $value): Collection;
    public function getAttachmentByUserPaginated(int $userId, int $perPage = 10): LengthAwarePaginator;
}

