<h3 class="mb-3">Next Lesson</h3>

@if($nextLesson)
<div class="card">
    <div class="row card-body align-items-center">
        <div class="col-md-4 text-center">
            <img src="{{ asset($nextLesson->image_url) }}" alt="" class="img-fluid" height="150" width="150">
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
@else
More Lessons coming soon
@endif
