<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\User;
use App\Lesson;
use App\Slide;
use App\Video;

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
        $videos = $lesson->videos;
        
        $data = [
            'lesson' => $lesson,
            'slides' => $slides,
            'videos' => $videos,
        ];
        
        return view('admin.lessons.show', $data);
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
        
        //スライドの数が0で無ければ、一番最後のslideのorderを取得する
        if($lesson->slides()->count() != 0) {
            $lastSlide_order = $lesson->slides()->orderBy('order', 'desc')->first()->order;
        }
        else {  //もしスライドが無ければ0に戻しちゃう
            $lastSlide_order = 0;
        }

        $lesson->slides()->create([
            'image_url'=>Storage::disk('s3')->url($path),
            'order' => $lastSlide_order + 10,  //最後のスライドの順番+10にする
        ]);
        
        return back();
    }
    
    public function destroy_slides($id)
    {
        $slide = Slide::find($id);
        
        $disk = Storage::disk('s3');
        $disk->delete($slide->image_url);
        $slide->delete();
        
        return back();
    }
    
    public function store_videos(Request $request, $id)
    {
        $this->validate($request, [
            'video_url' => 'required|active_url',
        ]);
        
        $lesson = Lesson::find($id);
        
        //ビデオの数が0で無ければ、一番最後のvideoのorderを取得する
        if($lesson->videos()->count() != 0) {
            $lastVideo_order = $lesson->videos()->orderBy('order', 'desc')->first()->order;
        }
        else {  //もしビデオが無ければ0に戻しちゃう
            $lastVideo_order = 0;
        }

        $lesson->videos()->create([
            'video_url'=>$request->video_url,
            'order' => $lastVideo_order + 10,  //最後のビデオの順番+10にする
        ]);
        
        return back();
    }
    
    public function destroy_videos($id)
    {
        Video::find($id)->delete();
        
        return back();
    }
}
