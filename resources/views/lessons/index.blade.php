@extends('layouts.app')

@section('content')
<h1 class="text-center">LESSONS</h1>
<div class="row text-center">
    @if(count($lessons) > 0)
        @foreach($lessons as $lesson)
          <div class="col-lg-3 col-md-6 mb-5">
            <div class="card">
              <div class="card-body">
                <h5 class="my-3">{{ $lesson->title }}</h5>
                @for($i=0; $i<$lesson->level; $i++)
                    <span class="fa fa-star"></span>
                @endfor
                <img src="{{ asset($lesson->image) }}" alt="" class="img-fluid">
                <p>{{ str_limit($lesson->description, $limit = 10, $end = '...') }}</p>
                {{ link_to_route('lessons.show', 'View', ['id'=>$lesson->id], ['class'=>'btn btn-info btn-block']) }}
              </div>
            </div>
          </div>
        @endforeach
    @endif
</div>

@endsection