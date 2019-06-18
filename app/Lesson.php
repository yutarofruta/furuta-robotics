<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['title', 'description', 'image_url', 'level', 'order'];

    
    public function completed_users() {
        return $this->belongsToMany(User::class, 'user_lesson', 'lesson_id', 'user_id')->withTimestamps();
    }
    
    
    public function slides() {
        return $this->hasMany(Slide::class);
    }
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    
    public function videos() {
        return $this->hasMany(Video::class);
    }
}
