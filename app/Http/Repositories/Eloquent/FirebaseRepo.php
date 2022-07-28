<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\FirebaseRepoInterface;
use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Models\Room;
use Kreait\Firebase\Factory;


class FirebaseRepo extends AbstractRepo implements FirebaseRepoInterface
{
    public function __construct()
    {
        parent::__construct(Room::class);
    }

    public function createDatabase(String $uri)
    {
        // ->withServiceAccount($serviceAccount)
        $firebase = (new Factory)
                    ->withDatabaseUri($uri)
                    ->create();
                    return $firebase->getDatabase();
                    //   $firebase->getDatabase();
                    //   return $database->getReference();
    }



}
