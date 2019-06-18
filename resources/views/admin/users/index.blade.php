@extends('layouts.app')

@section('content')

<h1>All Users : {{$users->count()}}</h1>

<table class="table table-sm table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Image</th>
            <th>Completed Lesson</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ link_to_route('admin.users.show', $user->name, ['id'=>$user->id], ['class'=>'']) }}</td>
            <td><img src="{{ asset($user->image) }}" class="rounded-circle" width="100"></img></td>
            <td>{{$user->completed_lessons()->first() ? $user->completed_lessons()->orderBy('order', 'desc')->first()->title : ''}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ link_to_route('admin.users.create', 'Create new User', [], ['class'=>'btn btn-primary']) }}
@endsection