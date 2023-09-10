<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentGuardiance;
use App\Models\Guardiance;
use App\Models\ClassRoom;
use App\Models\StudentClass;


class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'admission',
        'name_initials',
        'full_name',
        'dob',
        'gender',
        'enlist_date',
        'address',
        'status',
    ];

    public function guardiance()
    {
        return $this->belongsToMany(Guardiance::class, 'student_guardiance')
            ->using(StudentGuardiance::class); // Using the custom pivot model
    }

    public function classRooms()
    {
        return $this->belongsToMany(ClassRoom::class, 'student_classes')
            ->using(StudentClass::class)
            ->withPivot(['id','from', 'to', 'status'])->withTimestamps();
    }
}
