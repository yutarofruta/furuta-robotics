<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\User;
use App\Lesson;
use DB;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin() {
        
        return view('admin.admin');
    }
     
     
    public function index(Request $request)
    {
        //キーワードを取得
        $keyword = $request->input('keyword');

        //もしキーワードが入力されている場合
        if(!empty($keyword))
        {   
            //nameまたはschoolから検索
            $users = User::where('name', 'like', '%'.$keyword.'%')
                            ->orWhere('school', 'like', '%'.$keyword.'%')->get();

        }else{//キーワードが入力されていない場合
            $users = User::all();
        }
        
        $lessons = Lesson::all();
        
        $data = [
            'users'=>$users,
            'keyword' => $keyword,
            'lessons' => $lessons,
        ];
        
        return view('admin.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'image',
            'admin' => 'required|integer',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->name),
            'admin' => $request->admin,
        ]);
        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('/', $image, 'public');
            $user->image = Storage::disk('s3')->url($path);
            $user->save();
        }
        
        return redirect('admin/users');
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
        
        $lessons = Lesson::orderBy('order')->get();
        
        return view('admin.users.show', ['user'=>$user, 'lessons'=>$lessons]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        
        return view('admin.users.edit', ['user'=>$user]);
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
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'image' => 'image',
            'admin' => 'required|integer',
        ]);   
        
        $user = User::find($id);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'admin' => $request->admin,
        ]);
        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('/', $image, 'public');
            $user->image = Storage::disk('s3')->url($path);
            $user->save();
        }
    
        return redirect()->route('admin.users.show', ['id'=>$user->id]);
    }
    
    public function update_password(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);   
        
        $user = User::find($id);
        
        $user->update([
            'password' => bcrypt($request->password),
        ]);
        
        return redirect()->route('admin.users.show', ['id'=>$user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        
        return redirect('admin/users');
    }
}
