<?php

namespace App\Http\Repositories\Eloquent\Provider;

use App\Http\Repositories\Interfaces\Provider\ProviderRepoInterface;
use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Models\Provider;



class ProviderRepo extends AbstractRepo implements ProviderRepoInterface
{
    public function __construct()
    {
        parent::__construct(Provider::class);
    }



}
