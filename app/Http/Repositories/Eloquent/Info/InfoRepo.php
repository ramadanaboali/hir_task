<?php

namespace App\Http\Repositories\Eloquent\Info;

use App\Http\Repositories\Interfaces\Info\InfoRepoInterface;
use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Models\Info;



class InfoRepo extends AbstractRepo implements InfoRepoInterface
{
    public function __construct()
    {
        parent::__construct(Info::class);
    }



}
