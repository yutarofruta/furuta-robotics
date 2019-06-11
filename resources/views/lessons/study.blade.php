@extends('layouts.app')

@section('content')
<div id="slider" class="carousel slide" data-ride="carousel" data-wrap="false">
            <ol class="carousel-indicators">
              @for($i=0; $i<$count_slides+2; $i++)
              <li data-target="#slider" data-slide-to="{{ $i }}"></li>
              @endfor
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="/storage/img/first_slide.jpg" alt="First Slide">
                <div class="carousel-caption">
                  Start
                </div>
              </div>
              @foreach($slides as $slide)
              <div class="carousel-item">
                <img class="d-block img-fluid" src="{{ asset($slide->image_url) }}" alt="Slide {{ $slide->order }}">
              </div>
              @endforeach
              <div class="carousel-item">
                <img class="d-block img-fluid" src="/storage/img/last_slide.jpg" alt="Last Slide">
                <div class="carousel-caption">
                  @if(Auth::user()->is_completed($lesson->id))
                    {{ link_to_route('users.dashboard', 'CLEAR', [], ['class'=>'btn btn-info']) }}
                  @else
                    {!! Form::open(['route'=>['lessons.complete', $lesson->id]]) !!}
                      {{ Form::submit('CLEAR',['class'=>'btn btn-info']) }}
                    {!! Form::close() !!}
                  @endif
                </div>
              </div>
            </div>

            <!-- CONTROLS -->
            <a href="#slider" class="carousel-control-prev" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>

            <a href="#slider" class="carousel-control-next" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>
          </div>
@endsection