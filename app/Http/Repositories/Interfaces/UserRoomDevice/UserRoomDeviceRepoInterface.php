<?php

namespace App\Http\Repositories\Interfaces\UserRoomDevice;
interface UserRoomDeviceRepoInterface
{
    public function last_devices($user_id);
}
