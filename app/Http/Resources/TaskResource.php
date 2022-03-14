<?php

namespace App\Http\Resources;

use App\Http\Resources\User\RecordResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'project_id' => $this->project_id,
            'title' => $this->title,
            'price' => $this->price,
            'budget' => $this->budget,
            'desc' => $this->description,
            'status' => $this->status,
            'complete_status' => config('general.task.status.' . $this->complete_status),
            'apply_deadline' => $this->apply_deadline,
            'complete_deadline' => Carbon::createFromDate($this->complete_deadline)->diffForHumans(),
            'project' => $this->project,
            'language' => $this->project()->first()->language()->first(),
            'records' => ($this->records() !== null ? new RecordResource($this->records()->orderByDesc('created_at')->first()) : null),
            'checked' => false,
        ];
    }
}
