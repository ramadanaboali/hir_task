<?php

namespace App\Http\Resources\Alarm;
use App\Http\Resources\UserRoomDevice\UserRoomDeviceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlarmResource extends JsonResource
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
            'time' => $this->time,
            'bother' => $this->bother,
            'userRoomDevice_id' => $this->userRoomDevice_id,
            'userRoomDevice' => new UserRoomDeviceResource($this->userRoomDevice),
            'notify' => $this->notify,
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
