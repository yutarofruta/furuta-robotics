@extends('layouts.app')

@section('study')
<div id="slider" class="carousel slide" data-ride="carousel" data-wrap="false">
            <ol class="carousel-indicators">
              @for($i=0; $i<$count_slides+2; $i++)
              <li data-target="#slider" data-slide-to="{{ $i }}"></li>
              @endfor
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="/storage/img/first_slide.jpg" alt="First Slide" width="100%">
                <div class="carousel-caption">
                  Start
                </div>
              </div>
              @foreach($slides as $slide)
              <div class="carousel-item">
                <img class="d-block img-fluid" src="{{ asset($slide->image_url) }}" alt="Slide {{ $slide->order }}" width="100%">
              </div>
              @endforeach
              <div class="carousel-item">
                <img class="d-block img-fluid" src="/storage/img/last_slide.jpg" alt="Last Slide" width="100%">
                <div class="carousel-caption">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#clearModal">CLEAR</button>
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
          
          <!-- CLEAR MODAL-->
          <div class="modal fade" id="clearModal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Leave Your Comment for this Lesson!</h5>
                  <button class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                @if($comment)
                {!! Form::model($comment, ['route'=>['lessons.edit', $lesson->id], 'method'=>'PUT']) !!}
                  {{ Form::textarea('content', $comment->content, ['class'=>'form-control', 'rows'=>'10']) }}
                  {{ Form::submit('CLEAR',['class'=>'btn btn-info']) }}
                {!! Form::close() !!}
                @else
                {!! Form::open(['route'=>['lessons.complete', $lesson->id]]) !!}
                  {{ Form::textarea('content', old('content'), ['class'=>'form-control', 'rows'=>'10']) }}
                  {{ Form::submit('CLEAR',['class'=>'btn btn-info']) }}
                {!! Form::close() !!}
                @endif
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
@endsection