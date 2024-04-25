<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'birth_date',
        'gender',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birth_date' => 'date',
    ];

    // RelationShips
    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'created_by'); // Tasks where user is the creator
    }
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to'); // Tasks where user is the assignee
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'written_by'); // Specify the foreign key on the comments table
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'attached_by'); // Specify the foreign key on the attachments table
    }
}
