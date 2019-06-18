<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['video_url', 'lesson_id', 'order'];
    
    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }
}
