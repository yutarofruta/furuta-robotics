@extends('layouts.app')

@section('content')

<h1>User Info</h1>
<p>Name : {{$user->name}}</p>
<p>Role : {{$user->admin == 1 ? 'Administrator' : 'User'}}</p>
<p>Image : </p>
<img src="{{ asset($user->image) }}" width="200"></img>

<table class="table table-sm table-hover table-striped">

<thead>
    <tr>
        <th>Lesson</th>
        <th>Status</th>
        <th>Comment</th>
    </tr>
</thead>
<tbody>
    @foreach($lessons as $lesson)
    <tr>
        <td>{{$lesson->title}}</td>
        <td>{{$user->is_completed($lesson->id) ? 'Completed' : ''}}</td>
        <td>{{$user->is_completed($lesson->id) ? $lesson->comments()->where('user_id', $user->id)->first()->content : ''}}</td>
    </tr>
    @endforeach
</tbody>

</table>

{{ link_to_route('admin.users.edit', 'Edit', ['id'=>$user->id], ['class'=>'btn btn-primary']) }}

@if($user->admin != 1)
{!! Form::open(['route'=>['admin.users.destroy', $user->id], 'method'=>'DELETE']) !!}
    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}
@endif

@endsection