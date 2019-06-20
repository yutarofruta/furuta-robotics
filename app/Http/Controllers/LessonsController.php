<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\User;

class LessonsController extends Controller
{
    public function index() {
        
        $lessons = Lesson::orderBy('order')->paginate(12);
        
        //OPENにするレッスンのidを記録するための配列
        $openLessons = [];
        //クリアレッスンの一番大きいorderを取得
        $order = \Auth::user()->completed_lessons()->orderBy('order', 'desc')->first()->order;
        
        foreach($lessons as $lesson) {
            
            //クリアしたレッスン+1のidをキーとして渡しておく
            //view内ではisset($openLessons[$lesson->id])をしてtrue/falseでOPENを管理する
            $openLessons[$lesson->id] = $lesson;      
            
            //一番大きいorderのクリアレッスンの次のレッスンで最後のキー記録して抜ける
            if ($lesson->order > $order) {
                break;
            }
        }

        return view('lessons.index', ['lessons'=>$lessons, 'openLessons'=>$openLessons]);
    }
    
    public function show($id) {
        
        $lesson = Lesson::find($id);
        $user = \Auth::user();
        return view('lessons.show', ['lesson'=>$lesson, 'user'=>$user]);
    }
    
    public function study($id) {
        
        $user = \Auth::user();
    
        $lesson = Lesson::find($id);
                        
        $comment = $lesson->comments()->where('user_id', $user->id)->first();
        
        $slides = $lesson->slides()->orderBy('order')->get();
        $videos = $lesson->videos()->orderBy('order')->get();
        
        $count_slides = $lesson->slides()->count();
        $count_videos = $lesson->videos()->count();
        
        $data = [
          'lesson' => $lesson,
          'comment' => $comment,
          'slides' => $slides,
          'videos' => $videos,
          'count_slides' => $count_slides,
          'count_videos' => $count_videos,
        ];
        
        return view('lessons.study', $data);
    }
}
