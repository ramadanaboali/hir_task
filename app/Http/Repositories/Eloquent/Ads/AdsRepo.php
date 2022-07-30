<?php

namespace App\Http\Repositories\Eloquent\Ads;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Ads\AdsRepoInterface;
use App\Models\Ads;


class AdsRepo extends AbstractRepo implements AdsRepoInterface
{
    public function __construct()
    {
        parent::__construct(Ads::class);
    }
}
