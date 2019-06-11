@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Next LESSON -->
        @include('dashboard.next_lesson')
        <!-- LAST LESSON -->
        @include('dashboard.last_lesson')
    </div>
    <div class="col-md-4">
    <!-- USER INFO -->
        @include('dashboard.user_info')
    </div>
</div>
<div>
    @include('dashboard.completed_lessons')
</div>

@endsection