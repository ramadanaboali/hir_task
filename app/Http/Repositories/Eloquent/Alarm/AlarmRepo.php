<?php

namespace App\Http\Repositories\Eloquent\Alarm;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Alarm\AlarmRepoInterface;
use App\Models\Alarm;


class AlarmRepo extends AbstractRepo implements AlarmRepoInterface
{
    public function __construct()
    {
        parent::__construct(Alarm::class);
    }



}
