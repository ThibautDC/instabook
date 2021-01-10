<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected static function booted() {
        static::creating(function ($photo) {
            return !is_null($photo->group->users->find($photo->user_id));
        });
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function owner() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function users(){
        return $this->belongsToMany(User::class)->using(PhotoUser::class)->withPivot("id")->withTimestamps();
    }

    public function tags(){
        return $this->belongsToMany(Tag::class)->using(PhotoTag::class)->withPivot("id")->withTimestamps();
    }
    
}
 