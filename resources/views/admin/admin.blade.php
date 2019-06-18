@extends('layouts.app')

@section('content')

<h1>Admin DashBoard</h1>

{{ link_to_route('admin.users.index', 'Users Panel', [], ['class'=>'btn btn-primary']) }}

{{ link_to_route('admin.lessons.index', 'Lessons Panel', [], ['class'=>'btn btn-success']) }}

@endsection