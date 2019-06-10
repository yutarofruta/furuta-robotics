@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Next LESSON -->
        <div class="container">
            <h3 class="mb-3">Next Lesson</h3>

            <div class="card">
                <div class="row card-body align-items-center">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset($nextLesson->image) }}" alt="" class="img-fluid" height="150" width="150">
                    </div>
                    <div class="col-md-8 pl-3">
                        <h3>{{ $nextLesson->title }}</h3>
                        <p class="lead mb">{{ str_limit($nextLesson->description, $limit = 40, $end = '...') }}</p>

                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                @for($i=0; $i<$nextLesson->level; $i++)
                                    <span class="fa fa-star"></span>
                                @endfor
                            </div>
                            {{ link_to_route('lessons.show', 'View', ['id'=>$nextLesson->id], ['class'=>'btn btn-info']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- LAST LESSON -->
        <div class="container">
            <h3 class="mb-3">Last Lesson</h3>

            <div class="card">
                <div class="row card-body align-items-center">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset($lastLesson->image) }}" alt="" class="img-fluid" height="150" width="150">
                    </div>
                    <div class="col-md-8 pl-3">
                        <h3>{{ $lastLesson->title }}</h3>
                        <p class="lead mb">{{ str_limit($lastLesson->description, $limit = 40, $end = '...') }}</p>

                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                @for($i=0; $i<$lastLesson->level; $i++)
                                    <span class="fa fa-star"></span>
                                @endfor
                            </div>
                            {{ link_to_route('lessons.show', 'View', ['id'=>$lastLesson->id], ['class'=>'btn btn-info']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
    <!-- USER INFO -->
        <div class="card">
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
<div>
    <h1>Completed Lessons</h1>
    {{ link_to_route('lessons.index', 'More completed lessons...') }}
    <div class="row">
        
        @foreach($lessons as $lesson)
            <div class="col-lg-3 col-md-6 mb-5">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="my-3">{{ $lesson->title }}</h5>
                        <img src="{{ asset($lesson->image) }}" alt="" class="img-fluid mb-3">
                        {{ link_to_route('lessons.show', 'View', ['id'=>$lesson->id], ['class'=>'btn btn-info btn-block']) }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection