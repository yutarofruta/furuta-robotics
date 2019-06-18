@extends('layouts.app')

@section('content')
<div class="text-center">
        <h1>Create Lesson</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'admin.lessons.store', 'files'=>true]) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', old('description'), ['class'=>'form-control', 'rows'=>'4']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('image', 'Image') !!} <br>
                    {!! Form::file('image', []) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('level', 'Level') !!} <br>
                    {!! Form::radio('level', 1, true) !!} 1   &nbsp;&nbsp;
                    {!! Form::radio('level', 2, false) !!} 2   &nbsp;&nbsp;
                    {!! Form::radio('level', 3, false) !!} 3   &nbsp;&nbsp;
                    {!! Form::radio('level', 4, false) !!} 4   &nbsp;&nbsp;
                    {!! Form::radio('level', 5, false) !!} 5   &nbsp;&nbsp;
                </div>
                
                <div class="form-group">
                    {!! Form::label('order', 'Order') !!}
                    {!! Form::number('order', old('order'), ['class'=>'form-control']) !!}
                </div>
                

                {!! Form::submit('Create Lesson', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection

