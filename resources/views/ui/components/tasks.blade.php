<div class="row mt-4">
    <div class="col-2">
        <h2 class="mb-3"><b>{{ $title }}</b></h2>
    </div>
    <div class="col">
        @php
            $tasks = \App\Http\Resources\TaskResource::collection(\App\Models\Sites::limit(5)->get());
            //dd($tasks);
        @endphp
        @foreach($tasks as $task)
            {{--            {{ dd($task) }}--}}
            <div class="task">
                <div>
                    <a href="#">#{{ $loop->index + 1 }}</a>
                    <small class="price">${{ $task->price }}</small>
                </div>
                @if(in_array($loop->index, [2,4,6]))
                    <small class="type"><i class="flaticon-microphone-1"></i> Conversation</small>
                @else
                    <small class="type"><i class="flaticon-microphone"></i> Single Speech</small>
                @endif

                <small class="language">English</small>
                <small class="length">{{ \Carbon\Carbon::createFromFormat('h:i:s', $task->length)->format('i') }} min</small>
                <span>
                    <small class="d-block"><i>Deadline</i></small>
                    <small class="deadline">{{ \Carbon\Carbon::createFromDate($task->complete_deadline)->diffForHumans() }}</small></span>
                <div class="buttons">
                    <button class="claim"><i class="flaticon-add"></i>Claim</button>
                    <button class="decline"><i class="flaticon-cancel"></i> Decline</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
