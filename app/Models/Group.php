<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    //renvoi les photos du groupe
    public function photos() {
        return $this->hasMany(Photo::class);
    }

    //renvoi les utilisateur du groupe
    public function users(){
        return $this->belongsToMany(User::class)->using(GroupUser::class)->withPivot("id")->withTimestamps();
    }
}
