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
        'name', 'email', 'password','admin', 'image', 'exp', 'school'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function getImageAttribute($image) {
        
        if($image) {
            return $image;
        }
        else {
            return 'storage/img/user_icon.png';
        }
    }
    
    public function completed_lessons() {
        //クリア済みのレッスンを取得
        return $this->belongsToMany(Lesson::class, 'user_lesson', 'user_id', 'lesson_id')->withTimestamps();
    }
    
    public function complete($lessonId) {
        
        //すでにコンプリートしているかのチェック
        $exist = $this->is_completed($lessonId);
        
        $lesson = Lesson::find($lessonId);
        
        if($exist) {
            //既習であれば何もしない
            return false;
        } else {
            //既習で無ければ、経験値を増やしてコンプリートする
            $this->completed_lessons()->attach($lessonId);
            $this->exp += 100 + 50 * $lesson->level;
            $this->save();
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
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    
    public function make_comment($lessonId, $content) {
       
        //すでにコメントしていないか念のためチェック
        $exist = $this->is_commented($lessonId);
        
        if($exist) {
            //コメント済であれば何もしない
            return false;
        } else {
            //コメント済で無ければ、コメントの存在を記録する
            Comment::create([
                'content' => $content,
                'user_id' => $this->id,
                'lesson_id' => $lessonId
            ]);
            return true;
        }
    }
    
    public function is_commented($lessonId) {
        return $this->comments()->where('lesson_id', $lessonId)->exists();
    }
}
