<?php

namespace App\Http\Resources\UserRoom;

use App\Http\Resources\Room\RoomResource;
use App\Http\Repositories\Eloquent\Room\RoomRepo;
// use App\Http\Resources\UserRoomDevice\UserRoomDeviceResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRoomResource extends JsonResource
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
            'user' => new UserResource($this->user),
            'room' => new RoomResource($this->room),
            'devices' => $this->roomDevices ? count($this->roomDevices):0,
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
