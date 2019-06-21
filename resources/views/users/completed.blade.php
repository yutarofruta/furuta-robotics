@extends('layouts.app')

@section('content')
<h1 class="text-center">COMPLETED LESSONS</h1>
<div class="row text-center">
    @if(count($completed_lessons) > 0)
        @foreach($completed_lessons as $completed_lesson)
          <div class="col-lg-3 col-md-6 mb-5">
            <div class="card cleared-flag">
              <div class="card-body">
                <h5 class="my-3">{{ $completed_lesson->title }}</h5>
                @for($i=0; $i<$completed_lesson->level; $i++)
                    <span class="fa fa-star"></span>
                @endfor
                <img src="{{ asset($completed_lesson->image_url) }}" alt="" class="img-fluid">
                <p class="font-weight-bold">Your Comment</p>
                <p>
                  @foreach($completed_lesson->comments as $comment)
                    {{ $comment->content }}
                  @endforeach
                </p>
                {{ link_to_route('lessons.show', 'View', ['id'=>$completed_lesson->id], ['class'=>'btn btn-info btn-block']) }}
              </div>
            </div>
          </div>
        @endforeach
    @else
    <h3>No Completed Lessons.</h3>
    @endif
</div>

{{ $completed_lessons->render('pagination::bootstrap-4') }}

@endsection