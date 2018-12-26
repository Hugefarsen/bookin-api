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
        $room = $this->room;
        $room['properties'] = $this->room->properties;

        return [
            'start' => $this->start,
            'end' => $this->end,
            'name' => $this->name,
            'description' => $this->description,
            'owner' => $this->owner,
            'user' => $this->users,
            'room' => $room,
            'categories' => $this->categories,
        ];
    }
}
