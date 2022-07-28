<?php

namespace App\Http\Repositories\Eloquent\Rate;

use App\Http\Repositories\Interfaces\Rate\RateRepoInterface;
use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Models\Rate;



class RateRepo extends AbstractRepo implements RateRepoInterface
{
    public function __construct()
    {
        parent::__construct(Rate::class);
    }



}
