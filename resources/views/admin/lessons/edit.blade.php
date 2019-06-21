@extends('layouts.app')

@section('content')

{{ link_to_route('admin.lessons.show', 'Back', ['id'=>$lesson->id], ['class'=>'btn btn-success mb-5']) }}

<div class="text-center">
        <h1>Edit Lesson : {{ $lesson->title }}</h1>
</div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::model($lesson, ['route' => ['admin.lessons.update', 'id'=>$lesson->id], 'method'=>'PUT', 'files'=>true]) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', $lesson->title, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', $lesson->description, ['class'=>'form-control', 'rows'=>'4']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('image', 'Image') !!} <br>
                    {!! Form::file('image', $lesson->image) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('level', 'Level') !!} <br>
                    {!! Form::radio('level', 1, $lesson->level == 1) !!} 1   &nbsp;&nbsp;
                    {!! Form::radio('level', 2, $lesson->level == 2) !!} 2   &nbsp;&nbsp;
                    {!! Form::radio('level', 3, $lesson->level == 3) !!} 3   &nbsp;&nbsp;
                    {!! Form::radio('level', 4, $lesson->level == 4) !!} 4   &nbsp;&nbsp;
                    {!! Form::radio('level', 5, $lesson->level == 5) !!} 5   &nbsp;&nbsp;
                </div>
                
                <div class="form-group">
                    {!! Form::label('order', 'Order') !!}
                    {!! Form::number('order', $lesson->order, ['class'=>'form-control']) !!}
                </div>
                

                {!! Form::submit('Update Lesson', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection

