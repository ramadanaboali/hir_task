<?php

namespace App\Http\Repositories\Eloquent\Remote;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Remote\RemoteRepoInterface;
use App\Models\Remote;


class RemoteRepo extends AbstractRepo implements RemoteRepoInterface
{
    public function __construct()
    {
        parent::__construct(Remote::class);
    }



}
