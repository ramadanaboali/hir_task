<?php

namespace App\Http\Resources\Assigned;

use App\Http\Resources\Device\DeviceResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserRoom\UserRoomResource;
use App\Http\Resources\UserRoomDevice\UserRoomDeviceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignedResource extends JsonResource
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
            'userRoom' => new UserRoomResource($this->userRoom),
            'userRoomDevice' => new UserRoomDeviceResource($this->userRoomDevice),
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
