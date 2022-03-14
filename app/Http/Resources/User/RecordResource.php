<?php

namespace App\Http\Resources\User;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
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
            'name' => $this->name,
            'duration' => $this->duration,
            'path' => "/storage/$this->path",
            'validated' => $this->validated ? 'validated' : 'not validated',
            'create_date' => Carbon::parse($this->createad_at)->format('d m Y - h:i')
        ];
    }
}
