<div class="d-flex justify-content-between">
    <h3>Completed Lessons</h3>
    {{ link_to_route('users.completed', 'More completed lessons... >>>', ['id'=>$user->id], ['class'=>'align-self-center']) }}
</div>
@if(count($completed_lessons) > 0)
<div class="row">

    @foreach($completed_lessons as $lesson)
        <div class="col-lg-3 col-md-6 mb-5">
            <div class="card text-center cleared-flag">
                <div class="card-body">
                    <h5 class="my-3">{{ $lesson->title }}</h5>
                    <img src="{{ asset($lesson->image_url) }}" alt="" class="img-fluid mb-3">
                    {{ link_to_route('lessons.show', 'View', ['id'=>$lesson->id], ['class'=>'btn btn-info btn-block']) }}
                </div>
            </div>
        </div>
    @endforeach
</div>
@else
<p>You haven't completed any lesson yet</p>
@endif