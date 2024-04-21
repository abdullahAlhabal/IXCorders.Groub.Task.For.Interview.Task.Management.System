<?php

namespace App\Repositories;

use App\Contracts\Attachment\AttachmentRepositoryInterface;
use App\Models\Attachment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AttachmentRepository implements AttachmentRepositoryInterface
{
    public function getById(int $attachmentId): ?Attachment
    {
        return Attachment::find($attachmentId);
    }

    public function getAll(): Collection
    {
        return Attachment::all();
    }
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Attachment::paginate($perPage);
    }

    public function orderBy(string $column, string $direction = 'asc'): Collection
    {
        return Attachment::orderBy($column, $direction)->get();
    }

    public function paginateOrderedBy(string $column, string $direction = 'asc', int $perPage = 10): LengthAwarePaginator
    {
        return Attachment::orderBy($column, $direction)->paginate($perPage);
    }

    public function where(string $column, $value): Collection
    {
        return Attachment::where($column, $value)->get();
    }
    public function add(Attachment $attachment): void
    {
        $attachment->save();
    }

    public function update(Attachment $attachment): void
    {
        $attachment->save();
    }

    public function delete(Attachment $attachment): void
    {
        $attachment->delete();
    }

    public function save(Attachment $attachment): void
    {
        $attachment->save();
    }
}
