<?php

namespace App\Models;

use App\Models\ScheduledClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scheduledClasses()
    {
        return $this->hasMany(ScheduledClass::class);
    }
}