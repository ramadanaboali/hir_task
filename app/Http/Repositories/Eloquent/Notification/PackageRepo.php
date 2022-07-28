<?php

namespace App\Http\Repositories\Eloquent\Provider;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Provider\PackageRepoInterface;
use App\Models\Package;


class PackageRepo extends AbstractRepo implements PackageRepoInterface
{
    public function __construct()
    {
        parent::__construct(Package::class);
    }



}
