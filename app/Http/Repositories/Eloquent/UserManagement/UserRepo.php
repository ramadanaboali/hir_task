<?php

namespace App\Http\Repositories\Eloquent\UserManagement;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\UserManagement\UserRepoInterface;
use App\User;


class UserRepo extends AbstractRepo implements UserRepoInterface
{
    public function __construct()
    {
        parent::__construct(User::class);
    }



}
