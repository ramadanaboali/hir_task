<?php

namespace App\Http\Repositories\Eloquent\Assigned;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Assigned\AssignedRepoInterface;
use App\Models\Assigned;


class AssignedRepo extends AbstractRepo implements AssignedRepoInterface
{
    public function __construct()
    {
        parent::__construct(Assigned::class);
    }



}
