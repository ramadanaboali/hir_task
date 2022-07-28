<?php

namespace App\Http\Resources\UserRoomDevice;

use App\Http\Resources\Device\DeviceResource;
use App\Http\Resources\UserRoom\UserRoomResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRoomDeviceResource extends JsonResource
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
            'active' => $this->active,
            'reading_type' => $this->reading_type,
            'reading' => $this->reading,
            'bother' => $this->bother,
            'relay' => $this->relay,
            'relay_2' => $this->relay_2,
            'relay_3' => $this->relay_3,
            'relay_4' => $this->relay_4,
            'door_type' => $this->door_type,
            'switch_1' => $this->switch_1,
            'switch_2' => $this->switch_2,
            'switch_3' => $this->switch_3,
            'switch_4' => $this->switch_4,
            'event_value' => $this->event_value,
            'event_value_2' => $this->event_value_2,
            'event_action' => $this->event_action,
            'userRoom' => new UserRoomResource($this->userRoom),
            'device' => new DeviceResource($this->device),
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
