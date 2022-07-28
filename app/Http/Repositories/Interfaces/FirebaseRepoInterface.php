<?php

namespace App\Http\Repositories\Interfaces;

use App\Http\Requests\PaginateRequest;

interface FirebaseRepoInterface
{
   
    public function createDatabase(String $uri);
}
