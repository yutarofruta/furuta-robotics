@extends('layouts.app')

@section('content')

<h1>Lesson Info</h1>
<p>Title : {{ $lesson->title }}</p>
{{ link_to_route('admin.lessons.edit', 'Edit', ['id'=>$lesson->id], ['class'=>'btn btn-success']) }}

<p>Level : {{ $lesson->level }}</p>
<p>TitleImage : </p>
<img src="{{ asset($lesson->image_url)}}" width="200"></img>
<p>Order : {{ $lesson->order }}</p>
<p>Description : {{ $lesson->title }}</p>
<p>Number of Slides : {{ $slides->count() }}</p>

{!! Form::open(['route' =>['admin.slides.store', 'id'=>$lesson->id], 'files'=>true]) !!}
                
    <div class="form-group">
        {!! Form::label('image', 'Image') !!} <br>
        {!! Form::file('image', []) !!}
    </div>
    
    {!! Form::submit('Add Slides', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<div>
@foreach($slides as $slide)

<p>Slide order : {{$loop->iteration}}</p>
<img src="{{ asset($slide->image_url) }}" width="300"></img>
{!! Form::open(['route'=>['admin.slides.destroy', $slide->id], 'method'=>'DELETE']) !!}
    {!! Form::submit('Delete this Slide', ['class'=>'btn btn-warning']) !!}
{!! Form::close() !!}

@endforeach

</div>

{!! Form::open(['route' =>['admin.videos.store', 'id'=>$lesson->id]]) !!}
                
    <div class="form-group">
        {!! Form::label('video_url', 'Video URL') !!} <br>
        {!! Form::text('video_url','', ['class'=>'form-control']) !!}
    </div>
    
    {!! Form::submit('Add Videos', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<div>
@foreach($videos as $video)

<p>Video order : {{$loop->iteration}}</p>
<iframe width="300" src="{{ $video->video_url }}" frameborder="0" allowfullscreen></iframe>
{!! Form::open(['route'=>['admin.videos.destroy', $video->id], 'method'=>'DELETE']) !!}
    {!! Form::submit('Delete this Video', ['class'=>'btn btn-warning']) !!}
{!! Form::close() !!}

@endforeach

</div>

<hr>

{!! Form::open(['route'=>['admin.lessons.destroy', $lesson->id], 'method'=>'DELETE']) !!}
    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}

@endsection