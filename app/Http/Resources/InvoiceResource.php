<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $tasks = Task::whereIn('uuid', explode('|', $this->task_uuids))->get();
        $budget = array_sum($tasks->pluck('budget')->toArray());

        return [
            'status' => $this->status,
            'tasks' => TaskResource::collection(
                $tasks
            ),
            'budget' => $budget
        ];
    }
}
