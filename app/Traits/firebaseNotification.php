<?php
namespace App\Traits;


use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;


trait firebaseNotification
{
    public function fcm($token,$title,$body){
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound('default');
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $downstreamResponse = FCM::sendTo($token, $option, $notification, null);
        return $downstreamResponse;
    }

}
