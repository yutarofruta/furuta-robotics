<h3 class="mb-3">Last Lesson</h3>

@if($lastLesson)
<div class="card cleared-flag">
    <div class="row card-body align-items-center">
        <div class="col-md-4 text-center">
            <img src="{{ asset($lastLesson->image_url) }}" alt="" class="img-fluid" height="150" width="150">
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
@else
<h5>No Lesson yet</h5>
@endif