<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'attachment_path',
        'attached_by',
        'task_id',
    ];

    // Relationships
    public function uploader()
    {
        return $this->belongsTo(User::class, 'attached_by');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Custom methods
    public function getAttachmentUrl()
    {
        // Generate the full URL for accessing the attachment
        // You can customize this method based on your storage setup
        return "[Attachment URL Placeholder]"; // Replace with actual URL
    }
}
