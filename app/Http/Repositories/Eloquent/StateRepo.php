<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\StateRepoInterface;
use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Models\State;



class StateRepo extends AbstractRepo implements StateRepoInterface
{
    public function __construct()
    {
        parent::__construct(State::class);
    }



}
