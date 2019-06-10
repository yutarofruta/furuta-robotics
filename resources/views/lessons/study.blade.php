@extends('layouts.app')

@section('content')
<div id="slider" class="carousel slide" data-ride="carousel" data-wrap="false">
            <ol class="carousel-indicators">
              <li data-target="#slider" data-slide-to="0"></li>
              <li data-target="#slider" data-slide-to="1"></li>
              <li data-target="#slider" data-slide-to="2"></li>
              <li data-target="#slider" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="https://source.unsplash.com/wgq4eit198Q/1200x500" alt="First Slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="https://source.unsplash.com/WLUHO9A_xik/1200x500" alt="Second Slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="https://source.unsplash.com/4yta6mU66dE/1200x500" alt="Third Slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="https://source.unsplash.com/4yta6mU66dE/1200x500" alt="Last Slide">
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