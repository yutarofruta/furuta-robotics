@extends('layouts.app')

@section('content')


{{ link_to_route('admin.admin', 'Back', [], ['class'=>'btn btn-success mb-5']) }}

<h1>All Lessons : {{$lessons->count()}}</h1>

{{ link_to_route('admin.lessons.create', 'Create Lesson', [], ['class'=>'btn btn-primary']) }}

<table class="table table-sm table-hover table-striped">
    <thead>
        <tr>
            <th>Order</th>
            <th>Level</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lessons as $lesson)
        <tr>
            <td>{{ $lesson->order }}</td>
            <td>{{ $lesson->level }}</td>
            <td>{{ link_to_route('admin.lessons.show', $lesson->title, ['id'=>$lesson->id], ['class'=>'']) }}</td>
            <td width="50%">{{ $lesson->description }}</td>
            <td width="20%"><img src="{{ asset($lesson->image_url) }}" class="img-fluid"></img></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection