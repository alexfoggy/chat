<?php

namespace App\Events;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class TaskCounterEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $tasks;
    public $user;

    public function __construct($tasks)
    {
        $this->user = $tasks->first()->user;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('tasks.count');
    }

    public function broadcastWith()
    {
        $task_response = new Collection();

        $user = User::whereId($this->user->first()->id)->with('tasks')->first();

        foreach (config('general.task.status') as $key => $status) {
            if ($user->tasks()->where('complete_status', $key)->count() && !in_array($key, ['invoiced', 'checked', 'approved'])) {
                $task_response->push(
                    [
                        'name' => config("general.task.status.$key"),
                        'filter' => $key,
                        'count' => $user->tasks()->where('complete_status', $key)->count()
                    ]
                );
            }
        }


        return [
            'count' => $task_response,
            'tasks' => TaskResource::collection(Task::whereHas('user', function ($query) {
                $query->where('taskable_id', $this->user->first()->id);
            })->where('complete_status', 'new')->get()),
            'user' => $this->user->first()
        ];
    }
}
