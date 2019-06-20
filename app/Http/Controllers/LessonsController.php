<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\User;

class LessonsController extends Controller
{
    public function index() {
        
        $lessons = Lesson::orderBy('order')->paginate(12);
        
        $lastLesson = \Auth::user()->completed_lessons()->orderBy('order', 'desc')->first();
        
        //もうすでにレッスンをこなしていれば
        if($lastLesson != null) {
            //nextLessonはlastLessonの次のorderのものとする
            $nextLesson = Lesson::where('order', '>', $lastLesson->order)->orderBy('order')->first();
        }
        else {
            //ユーザがまだ一つもクリアしていない場合はLesson1を表示する
            $nextLesson = Lesson::orderBy('order')->first();
        }
        
        $data = [
            'lessons'=>$lessons,
            'lastLesson'=>$lastLesson,
            'nextLesson'=>$nextLesson,
        ];

        return view('lessons.index', $data);
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
