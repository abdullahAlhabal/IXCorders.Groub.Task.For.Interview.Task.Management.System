<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringTask extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'short_description',
        'long_description',
        'frequency',
        'start_date',
        'end_date',
        'created_by',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    //  methods
    public function isActive()
    {
        return now()->between($this->start_date, $this->end_date);
    }
}
