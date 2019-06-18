<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\User;
use App\Lesson;
use App\Slide;

class AdminLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::orderBy('order')->get();
        
        return view('admin.lessons.index', ['lessons'=>$lessons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lessons.create');
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'level' => 'required|integer|min:1|max:5',
            'order' => 'required',
            'image' => 'required|image',
        ]);
        
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('/', $image, 'public');
        
        Lesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => Storage::disk('s3')->url($path),
            'level' => $request->level,
            'order' => $request->order,
        ]);
        
        return redirect('admin/lessons');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        
        $slides = $lesson->slides;
        
        return view('admin.lessons.show', ['lesson'=>$lesson, 'slides'=>$slides]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::find($id);
        
        return view('admin.lessons.edit', ['lesson'=>$lesson]);
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'level' => 'required|integer|min:1|max:5',
            'order' => 'required',
        ]);   
        
        $lesson = Lesson::find($id);
        
        $lesson->update([
            'title' => $request->title,
            'description' => $request->description,
            'level' => $request->level,
            'order' => $request->order,
        ]);
        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('/', $image, 'public');
            $lesson->image_url = Storage::disk('s3')->url($path);
            $lesson->save();
        }
        
        return redirect('admin/lessons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lesson::find($id)->delete();
        
        return redirect('admin/lessons');
    }
    
    public function store_slides(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'required|image',
        ]);
        
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('/', $image, 'public');
        
        $lesson = Lesson::find($id);
        //一番最後のslideのorderを取得する
        $lastSlide_order = $lesson->slides()->orderBy('order', 'desc')->first()->order;
        
        $lesson->slides()->create([
            'image_url'=>Storage::disk('s3')->url($path),
            'order' => $lastSlide_order + 10,  //最後のスライドの順番+10にする
        ]);
        
        return back();
    }
    
    public function destroy_slides($id)
    {
        Slide::find($id)->delete();
        
        return back();
    }
}
