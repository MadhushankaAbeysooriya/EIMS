<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserGroup extends Pivot
{
    use HasFactory;
    protected $table = 'user_groups';
    protected $fillable = [
        'group_id',
        'user_id',
    ];
}
