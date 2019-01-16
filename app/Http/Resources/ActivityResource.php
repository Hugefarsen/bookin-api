<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'start' => $this->start,
            'end' => $this->end,
            'owner' => $this->owner,
            'users' => $this->users,
            'room' => $this->room,
            'category' => $this->category,
            'id' => $this->id,
        ];
    }
}
