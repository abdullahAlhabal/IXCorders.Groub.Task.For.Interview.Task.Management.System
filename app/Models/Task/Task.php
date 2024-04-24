<?php

namespace App\Models;

// use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'short_description',
        'long_description',
        'due_date',
        'priority',
        // 'status_id',
        'status',
        'created_by',
        'assigned_to',
        'is_recurring',
        'recurring_pattern',
        'recurring_interval'
    ];

    protected $guarded = ['created_at', 'updated_at', 'id'];


    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // public function status()
    // {
    //     return $this->belongsTo(TaskStatus::class, 'status_id');
    // }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    // Custom methods
    public function isActive()
    {
        // Check if the task is active (based on status, due date, etc.)
        return $this->status === 'In Progress' && $this->due_date >= now();
    }

    public function isCreatedByCurrentUser()
    {
        // Check if the task was created by the currently authenticated user
        return $this->created_by === Auth::id();
    }

    public function getFormattedDueDateAttribute()
    {
        // Format the due_date timestamp as desired (e.g., "2023-04-20 15:39:05" -> "Apr 20, 2023, 3:39 PM")
        return $this->due_date->format('M d, Y, g:i A');
    }

}
