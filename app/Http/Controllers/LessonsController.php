<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\User;

class LessonsController extends Controller
{
    public function index() {
        
        $lessons = Lesson::orderBy('order')->paginate(12);
        
        return view('lessons.index', ['lessons'=>$lessons]);
    }
    
    public function show($id) {
        
        $lesson = Lesson::find($id);
        $user = \Auth::user();
        
        return view('lessons.show', ['lesson'=>$lesson, 'user'=>$user]);
    }
    
    public function study($id) {
        
        $lesson = Lesson::find($id);
        
        $slides = $lesson->slides()->orderBy('order')->get();
        
        $count_slides = $lesson->slides()->count();
        
        $data = [
          'lesson' => $lesson,
          'slides' => $slides,
          'count_slides' => $count_slides
        ];
        
        return view('lessons.study', $data);
    }
}
