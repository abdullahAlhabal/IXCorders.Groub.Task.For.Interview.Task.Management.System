<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'written_by',
        'task_id',
    ];


    protected $guarded = ['created_at', 'updated_at', 'id'];


    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'written_by');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Custom methods
    public function getFormattedCreatedAtAttribute()
    {
        // Format the created_at timestamp as desired (e.g., "2023-04-20 15:39:05" -> "Apr 20, 2023, 3:39 PM")
        return $this->created_at->format('M d, Y, g:i A');
    }
}
