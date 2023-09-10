<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group;
use App\Models\UserGroup;
use App\Models\GroupGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = [
        'name',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_groups')
                ->using(UserGroup::class); // Using the custom pivot model
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_groups', 'group_id', 'group_group_id')
                ->using(GroupGroup::class); // Using the custom pivot model
    }
}
