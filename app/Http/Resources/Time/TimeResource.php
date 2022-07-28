<?php

namespace App\Http\Resources\Time;
use App\Http\Resources\UserRoomDevice\UserRoomDeviceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeResource extends JsonResource
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
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'event_action' => $this->event_action,
            'device_action' => $this->device_action,
            'userRoomDevice_id' => $this->userRoomDevice_id,
            'userRoomDevice' => new UserRoomDeviceResource($this->userRoomDevice),
            'days' => json_decode($this->days),
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
