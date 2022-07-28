<?php

namespace App\Http\Repositories\Eloquent\Time;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Time\TimeRepoInterface;
use App\Models\Timing;


class TimeRepo extends AbstractRepo implements TimeRepoInterface
{
    public function __construct()
    {
        parent::__construct(Timing::class);
    }



}
