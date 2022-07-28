<?php

namespace App\Http\Repositories\Eloquent\Voice;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Voice\VoiceRepoInterface;
use App\Models\Voice;


class VoiceRepo extends AbstractRepo implements VoiceRepoInterface
{
    public function __construct()
    {
        parent::__construct(Voice::class);
    }



}
