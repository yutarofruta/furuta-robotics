@extends('layouts.app')

@section('content')
<h1 class="text-center">USERS RANKING</h1>

@if (count($users) > 0)
<table class="table table-striped text-center">
    <thead>
        <tr>
            <th>Rank</th>
            <th>Image</th>
            <th>Name</th>
            <th>Exp</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <th width="30%">{{ $user->id }}</th>
            <td width="10%"><img src="{{ asset($user->image) }}" alt="" class="img-fluid rounded-circle"></td>
            <td width="30%">{{ $user->name }}</td>
            <td width="30%">{{ $user->exp }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->render('pagination::bootstrap-4') }}
@else
    <p>No user yet</p>
@endif
    
@endsection