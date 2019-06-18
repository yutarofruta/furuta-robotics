@extends('layouts.app')

@section('content')
<h1 class="text-center">LESSONS</h1>
<div class="row text-center">
    @if(count($lessons) > 0)
        @foreach($lessons as $lesson)
          <div class="col-lg-3 col-md-6 mb-5">
            <div class="card {{ Auth::user()->is_completed($lesson->id) ? 'cleared-flag' : '' }}">
              <div class="card-body">
                <h5 class="my-3">{{ $lesson->title }}</h5>
                <div>
                  @for($i=0; $i<$lesson->level; $i++)
                    <span class="fa fa-star"></span>
                  @endfor
                </div>
                <img src="{{ asset($lesson->image_url) }}" alt="" class="img-fluid">
                <p>{{ str_limit($lesson->description, $limit = 20, $end = '...') }}</p>
                @if(Auth::user()->is_completed($lesson->id) || $lesson == $nextLesson)
                {{ link_to_route('lessons.show', 'View', ['id'=>$lesson->id], ['class'=>'btn btn-info btn-block']) }}
                @else
                <a href="" class="btn btn-warning disabled btn-block"><i class="fas fa-lock"></i></a>
                @endif
              </div>
            </div>
          </div>
        @endforeach
    @endif
</div>

{{ $lessons->render('pagination::bootstrap-4') }}

@endsection