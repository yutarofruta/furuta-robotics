@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
            
    </div>
    <div class="col-md-4">
    <!-- USER INFO -->
        <div class="card mt-5">
            <div class="card-body p-4">
                <div class="text-center">
                    <img src="{{ asset($user->image) }}" alt="" class="" height="100" width="100">
                    <h3 class="mt-4">{{ $user->name }}</h3>
                    <hr class="my-4">
                    <h3>Exp</h3>
                    <p class="display-4">{{ $user->exp }}</p>

                    <hr class="my-4">

                    <h3>Complited Lessons</h3>
                    <p class="display-4">0</p>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width:5%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection