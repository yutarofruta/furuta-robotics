@extends('layouts.app')

@section('content')
<h1 class="text-center">USERS RANKING</h1>

@if (count($users) > 0)
<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Name</th>
            <th>Exp</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td><img src="{{ asset($user->image) }}" alt="" class="" height="100" width="100"></td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->exp }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->render('pagination::bootstrap-4') }}
@else
    <p>No user yet</p>
@endif
    
@endsection