<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['title', 'description', 'image', 'level', 'order'];

    
    public function completed_users() {
        return $this->belongsToMany(User::class, 'user_lesson', 'lesson_id', 'user_id')->withTimestamps();
    }
}
