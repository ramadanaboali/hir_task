<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\RegionRepoInterface;
use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Models\Region;



class RegionRepo extends AbstractRepo implements RegionRepoInterface
{
    public function __construct()
    {
        parent::__construct(Region::class);
    }



}
