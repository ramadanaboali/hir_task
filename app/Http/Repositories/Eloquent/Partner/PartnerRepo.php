<?php

namespace App\Http\Repositories\Eloquent\Partner;

use App\Http\Repositories\Interfaces\Partner\PartnerRepoInterface;
use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Models\Partner;



class PartnerRepo extends AbstractRepo implements PartnerRepoInterface
{
    public function __construct()
    {
        parent::__construct(Partner::class);
    }



}
