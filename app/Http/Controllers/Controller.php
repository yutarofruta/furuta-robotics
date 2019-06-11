<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Lesson;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function counts($user) {
        $count_completed_lessons = $user->completed_lessons()->count();
        $count_all_lessons = Lesson::all()->count();

        return [
            'count_completed_lessons' => $count_completed_lessons,
            'count_all_lessons' => $count_all_lessons,
        ];
    }
    
}
