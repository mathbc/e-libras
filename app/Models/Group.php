<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name_group',
        'description_group'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'post_groups');
    }
}
