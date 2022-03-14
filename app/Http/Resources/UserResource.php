<?php

namespace App\Http\Resources;

//use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Language;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' =>  $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'token' => $this->token,
            'avatar' => $this->avatar,
            'phone' => $this->phone,
            'level' => ucfirst(config('general.language.levels.' . $this->main_language_level)),
            'main_language' => Language::find($this->main_language)->name ?? '',
            'country' => Country::find($this->country)->name ?? '',
            'voice' => $this->voice,
            'current_location' => $this->current_location,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'paypal' => $this->paypal,
            'languages' => $this->languages->first()
        ];
    }
}
