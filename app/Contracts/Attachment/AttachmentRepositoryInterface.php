<?php

namespace App\Contracts\Attachment;

use App\Models\Attachment;
use Illuminate\Support\Collection;

interface AttachmentRepositoryInterface
{
    public function getById(int $attachmentId): ?Attachment;
    public function getAll(): Collection;
    public function add(Attachment $attachment): void;
    public function update(Attachment $attachment): void;
    public function delete(Attachment $attachment): void;
    public function save(Attachment $attachment): void;
}
