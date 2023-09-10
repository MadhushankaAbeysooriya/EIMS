<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentClass extends Pivot
{
    use HasFactory;
    protected $table = 'student_classes';
    protected $fillable = [
        'student_id',
        'class_room_id',
        'from',
        'to',
        'status',
    ];
}
