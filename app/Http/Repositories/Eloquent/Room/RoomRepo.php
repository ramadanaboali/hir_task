<?php

namespace App\Http\Repositories\Eloquent\Room;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Room\RoomRepoInterface;
use App\Models\Room;


class RoomRepo extends AbstractRepo implements RoomRepoInterface
{
    public function __construct()
    {
        parent::__construct(Room::class);
    }
    public function myrooms($user_id)
    {
        return Room::where('user_id',$user_id)->orWhere('user_id','=',null)->get();
        
    }


}
