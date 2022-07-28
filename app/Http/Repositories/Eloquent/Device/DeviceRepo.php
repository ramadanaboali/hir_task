<?php

namespace App\Http\Repositories\Eloquent\Device;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Device\DeviceRepoInterface;
use App\Models\Device;


class DeviceRepo extends AbstractRepo implements DeviceRepoInterface
{
    public function __construct()
    {
        parent::__construct(Device::class);
    }

    public function mydevices($user_id)
    {
        return Device::where('user_id',$user_id)->orWhere('user_id','=',null)->get();
        
    }
}
