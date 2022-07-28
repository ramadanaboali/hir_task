<?php

namespace App\Http\Repositories\Eloquent\Notification;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Notification\NotificationRepoInterface;
use App\Models\Notification;


class NotificationRepo extends AbstractRepo implements NotificationRepoInterface
{
    public function __construct()
    {
        parent::__construct(Notification::class);
    }



}
