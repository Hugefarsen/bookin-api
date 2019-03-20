<?php

namespace App\Http\Resources;

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
            'name' => $this->name,
            'role' => $this->roles,
            'email' => $this->email,
            'ownsActivity' => ActivityResource::collection($this->ownsActivity),
            'goesToActivity' => ActivityResource::collection($this->goesToActivity),
            'id' => $this->id,
        ];
    }
}
