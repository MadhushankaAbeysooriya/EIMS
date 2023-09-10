<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\GuardianceType;
use App\Models\Student;
use App\Models\StudentGuardiance;

class Guardiance extends Model
{
    use HasFactory;
    protected $table = 'guardiances';
    protected $fillable = [
        'nic',
        'sec_contact',
        'guardiance_type_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function guardiance_type()
    {
        return $this->belongsTo(GuardianceType::class, 'guardiance_type_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_guardiance')
            ->using(StudentGuardiance::class); // Using the custom pivot model
    }
}
