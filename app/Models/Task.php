<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;

class Task extends Model
{
    use HasFactory, Searchable;


    protected $fillable = [
        'title',
        'short_description',
        'long_description',
        'due_date',
        'priority',
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
        return $this->status === 'In Progress' && $this->due_date >= now();
    }

    public function isCreatedByCurrentUser()
    {
        return $this->created_by === Auth::id();
    }

    public function getFormattedDueDateAttribute()
    {
        return $this->due_date->format('M d, Y, g:i A');
    }

    public function toSearchableArray()
    {
        return [
            'title'             => $this->title,
            'short_description' => $this->short_description,
            'due_date'          => $this->due_date,
            'priority'          => $this->priority,
            'status'            => $this->status,
            'is_recurring'      => $this->is_recurring,
            'recurring_pattern' => $this->recurring_pattern,
        ];
    }

}
