<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupGroup extends Pivot
{
    use HasFactory;
    protected $table = 'group_groups';
    protected $fillable = [
        'group_id',
        'group_group_id',
    ];
}
