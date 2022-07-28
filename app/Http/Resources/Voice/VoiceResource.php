<?php

namespace App\Http\Resources\Voice;
use App\Http\Resources\UserRoomDevice\UserRoomDeviceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'phrase' => $this->phrase,
            'phrase_open' => $this->phrase_open,
            'phrase_close' => $this->phrase_close,
            'userRoomDevice_id' => $this->userRoomDevice_id,
            'userRoomDevice' => new UserRoomDeviceResource($this->userRoomDevice),
            'active' => $this->active,
            'create_dates' => [
                'created_at_human' => $this->created_at->diffForHumans(),
                'created_at' => $this->created_at
            ],
            'update_dates' => [
                'updated_at_human' => $this->updated_at->diffForHumans(),
                'updated_at' => $this->updated_at
            ],
        ];
    }
}
