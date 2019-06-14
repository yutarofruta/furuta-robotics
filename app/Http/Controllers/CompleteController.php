<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;

class CompleteController extends Controller
{
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required|max:500',
        ]);
        
        $user = \Auth::user();

        $user->make_comment($id, $request->content);

        $user->complete($id);
        
        return redirect('/dashboard');
    }
    
    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required|max:500',
        ]);
        
        $lesson = Lesson::find($id);
        
        $comment = $lesson->comments()->where('user_id', \Auth::id())->first();
        
        $comment->content = $request->content;
        $comment->save();
        
        return redirect('/dashboard');
    }

    public function destroy($id)
    {
        \Auth::user()->incomplete($id);
        return back();
    }
}
