<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['image_url', 'lesson_id', 'order'];
    
    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }
}
