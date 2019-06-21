@extends('layouts.app')

@section('content')

{{ link_to_route('admin.admin', 'Back', [], ['class'=>'btn btn-success mb-5']) }}

<h1>All Users : {{$users->count()}}</h1>

{{ link_to_route('admin.users.create', 'Create new User', [], ['class'=>'btn btn-primary mb-5']) }}


{!! Form::open(['route' => 'admin.users.index', 'method'=>'GET']) !!}
    <div class="form-group">
        {!! Form::text('keyword', $keyword) !!}
    </div>
    {!! Form::submit('Search', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}


<table class="table table-sm table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>School</th>
            <th>Image</th>
            <th>Newest Completed Lesson</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ link_to_route('admin.users.show', $user->name, ['id'=>$user->id], ['class'=>'']) }}</td>
            <td>{{ $user->school }}</td>
            <td><img src="{{ asset($user->image) }}" class="rounded-circle" width="100"></img></td>
            <td>{{$user->completed_lessons()->first() ? $user->completed_lessons()->orderBy('order', 'desc')->first()->title : ''}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- 進捗状況を記録しようか考えたが、現時点では作らなかった--}}
{{--
<h3>Progress</h3>
<table>
    <tr>
        <th>Name</th>
        @foreach($lessons as $lesson)
        <th>{{ $lesson->title }}</th>
        @endforeach
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        @foreach($lessons as $lesson)
            <th>{{ $user->is_completed($lesson->id) }}</th>
        @endforeach
    </tr>
    @endforeach
</table>

--}}

@endsection