<?php

namespace App\Models;

use App\Models\User;
use App\Models\ClassType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduledClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'date_time',
        'class_type_id',
    ];

    protected $casts = [
        'date_time' => 'datetime',
    ];

    protected $with = ['classType'];

    public function instructor()
    {
        return $this->belongsTo(User::class);
    }

    public function classType()
    {
        return $this->belongsTo(ClassType::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'bookings')->withTimestamps();
    }

    public function scopeUpcoming($query)
    {
        $query->where('date_time', '>', now());
    }

    public function scopeNotBooked($query)
    {
        $query->whereDoesntHave('members', function ($query) {
            $query->where('user_id', auth()->id());
        });
    }
}