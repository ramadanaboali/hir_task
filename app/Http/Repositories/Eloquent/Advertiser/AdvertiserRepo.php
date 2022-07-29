<?php

namespace App\Http\Repositories\Eloquent\Advertiser;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Advertiser\AdvertiserRepoInterface;
use App\Models\Advertiser;


class AdvertiserRepo extends AbstractRepo implements AdvertiserRepoInterface
{
    public function __construct()
    {
        parent::__construct(Advertiser::class);
    }
}
