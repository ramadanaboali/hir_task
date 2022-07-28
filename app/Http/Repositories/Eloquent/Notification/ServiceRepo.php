<?php

namespace App\Http\Repositories\Eloquent\Provider;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Provider\ServiceRepoInterface;
use App\Models\Service;


class ServiceRepo extends AbstractRepo implements ServiceRepoInterface
{
    public function __construct()
    {
        parent::__construct(Service::class);
    }



}
