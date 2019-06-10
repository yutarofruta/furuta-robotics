<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function completed_lessons() {
        //クリア済みのレッスンを取得
        return $this->belongsToMany(Lesson::class, 'user_lesson', 'user_id', 'lesson_id')->withTimestamps();
    }
    
    public function complete($lessonId) {
        
        //すでにコンプリートしているかのチェック
        $exist = $this->is_completed($lessonId);
        
        if($exist) {
            //既習であれば何もしない
            return false;
        } else {
            //既習で無ければ、コンプリートする
            $this->completed_lessons()->attach($lessonId);
            return true;
        }
    }
    
    public function incomplete($lessonId) {
        
        //すでにコンプリートしているかのチェック
        $exist = $this->is_completed($lessonId);
        
        if($exist) {
            //既習であればリムーブする
            $this->completed_lessons()->detach($lessonId);
            return true;
        } else {
            //既習で無ければ、そのまま
            return false;
        }
    }
    
    public function is_completed($lessonId) {
        return $this->completed_lessons()->where('lesson_id', $lessonId)->exists();
    }
}
