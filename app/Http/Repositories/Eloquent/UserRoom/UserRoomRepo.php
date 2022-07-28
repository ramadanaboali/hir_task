<?php

namespace App\Http\Repositories\Eloquent\UserRoom;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\UserRoom\UserRoomRepoInterface;
use App\Models\UserRoom;


class UserRoomRepo extends AbstractRepo implements UserRoomRepoInterface
{
    public function __construct()
    {
        parent::__construct(UserRoom::class);
    }



}
