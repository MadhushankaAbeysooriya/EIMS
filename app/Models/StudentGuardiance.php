<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentGuardiance extends Pivot
{
    use HasFactory;
    protected $table = 'student_guardiance';
    protected $fillable = [
        'student_id',
        'guardiance_id',
    ];
}
