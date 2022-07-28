<?php

namespace App\Http\Repositories\Eloquent\UserRoomDevice;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\UserRoomDevice\UserRoomDeviceRepoInterface;
use App\Models\UserRoomDevice;
use App\Models\UserRoom;


class UserRoomDeviceRepo extends AbstractRepo implements UserRoomDeviceRepoInterface
{
    public function __construct()
    {
        parent::__construct(UserRoomDevice::class);
    }

    public function last_devices($user_id)
    {
        $userRooms=UserRoom::where('user_id',$user_id)->orderBy('updated_at', 'DESC')->skip(0)->take(10)->pluck("id");
        return UserRoomDevice::whereIn('userRoom_id',$userRooms)->orderBy('updated_at', 'DESC')->skip(0)->take(10)->get();

    }

}
