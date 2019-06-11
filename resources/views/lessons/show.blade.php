@extends('layouts.app')

@section('content')
<div class="card {{Auth::user()->is_completed($lesson->id) ? 'cleared-flag' : ''}}">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 text-center">
                <img src="{{ asset($lesson->image_url) }}" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <h1 class="card-title">{{ $lesson->title }}
                @for($i=0; $i<$lesson->level; $i++)
                    <span class="fa fa-star"></span>
                @endfor
                </h1>
                <p class="card-text">{{ nl2br($lesson->description) }}</p>
                @if($user->is_completed($lesson->id))
                {{ link_to_route('lessons.study', 'Review', ['id'=>$lesson->id], ['class'=>'btn btn-info btn-block']) }}
                @else
                {{ link_to_route('lessons.study', 'Start', ['id'=>$lesson->id], ['class'=>'btn btn-info btn-block']) }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection