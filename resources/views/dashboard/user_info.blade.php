<div class="card">
    <div class="card-body p-4">
        <div class="text-center">
            <img src="{{ asset($user->image) }}" alt="" class="" height="100" width="100">
            <h3 class="mt-4">{{ $user->name }}</h3>
            <hr class="my-4">
            <h3>Exp</h3>
            <p class="display-4">{{ $user->exp }}</p>

            <hr class="my-4">

            <h3>Completed Lessons</h3>
            <p class="display-4">{{ $count_completed_lessons }}</p>
            <div class="progress">
                <div class="progress-bar bg-success" style="width:{{ $count_completed_lessons / $count_all_lessons * 100 }}%"></div>
            </div>
        </div>
    </div>
</div>