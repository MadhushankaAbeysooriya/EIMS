<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\StudentClass;

class ClassRoom extends Model
{
    use HasFactory;
    protected $table = 'class_rooms';
    protected $fillable = [
        'name',
        'abbr',
        'status',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_classes')
            ->using(StudentClass::class)
            ->withPivot(['id','from', 'to', 'status'])->withTimestamps();
    }
}
