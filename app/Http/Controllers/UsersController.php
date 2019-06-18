<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Lesson;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('exp', 'desc')->paginate(5);
        
        return view('users.index', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        return view('users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function dashboard() {
        
        $user = \Auth::user();
        
        $completed_lessons = $user->completed_lessons()->orderBy('order', 'desc')->take(4)->get();
        
        $lastLesson = $user->completed_lessons()->orderBy('order', 'desc')->first();
        $nextLesson = Lesson::whereNotIn('id', $user->completed_lessons->pluck('id')->toArray())->orderBy('order')->first();
        
        $data = [
            'user'=>$user,
            'lastLesson'=>$lastLesson,
            'nextLesson'=>$nextLesson,
            'completed_lessons'=>$completed_lessons,
        ];
        
        $data += $this->counts($user);
        
        return view('users.show', $data);
    }
    
    public function completed() {
        
        $user = \Auth::user();
        
        //次ページで$completed_lesson->commentsをするとN+1問題が起きるので、ここでコメントも取得しておく
        //ユーザのコメントを事前取得しつつ、ユーザのクリアしたレッスンを取得する
        $completed_lessons = $user->completed_lessons()->with(['comments' => function ($query) use ($user) {
                                return $query->where('user_id', $user->id);
                            }])->orderBy('order')->paginate(12);

        //(クリアしたレッスンのユーザコメント)を事前情報として持つ、ユーザのクリアレッスンが取得される
        
        return view('users.completed', ['completed_lessons'=>$completed_lessons]);
    }
}
