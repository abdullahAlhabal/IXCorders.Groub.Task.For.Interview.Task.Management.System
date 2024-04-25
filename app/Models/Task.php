<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
    public function isActive(): bool
    {
        return $this->status === 'In Progress' && $this->due_date >= now();
    }
    public function isRecurring(): bool
    {
        return $this->is_recurring;
    }
    public function isCreatedByCurrentUser(): bool
    {
        return $this->created_by === Auth::id();
    }
    public function scopeByRecurringPattern(Builder $query, string $pattern)
    {
        return $query->where('recurring_pattern', $pattern);
    }
    public function scopeByPriority(Builder $query, string $priority)
    {
        return $query->where('priority', $priority);
    }
    public function scopeByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    // Search using Scout Package
    public function toSearchableArray()
    {
        return [
            'title'             => $this->title,
            'short_description' => $this->short_description,
            'long_description'  => $this->long_description,
        ];
    }

}
