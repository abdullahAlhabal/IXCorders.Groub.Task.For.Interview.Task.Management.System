<?php

namespace App\Contracts\Attachment;

use App\Models\Attachment;
use Illuminate\Support\Collection;

interface AttachmentServicesInterface
{
    public function getTaskById(int $attachmentId): ?Attachment;
    public function getAllTasks(): Collection;
    public function addTask(Attachment $attachment): void;
    public function updateTask(Attachment $attachment): void;
    public function deleteTask(Attachment $attachment): void;
    public function saveTask(Attachment $attachment): void;
}
