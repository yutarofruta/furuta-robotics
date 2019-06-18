<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\User;

class LessonsController extends Controller
{
    public function index() {
        
        $lessons = Lesson::orderBy('order')->paginate(12);
        
        $nextLesson = Lesson::whereNotIn('id', \Auth::user()->completed_lessons->pluck('id')->toArray())->orderBy('order')->first();

        return view('lessons.index', ['lessons'=>$lessons, 'nextLesson'=>$nextLesson]);
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
        
        $count_slides = $lesson->slides()->count();
        
        $data = [
          'lesson' => $lesson,
          'comment' => $comment,
          'slides' => $slides,
          'count_slides' => $count_slides
        ];
        
        return view('lessons.study', $data);
    }
}
