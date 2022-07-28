<?php

namespace App\Http\Repositories\Eloquent\Provider;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Provider\PaymentRepoInterface;
use App\Models\Notification;
use Illuminate\Support\Facades\Http;


class PaymentRepo extends AbstractRepo implements PaymentRepoInterface
{
    public function __construct()
    {
        parent::__construct(Notification::class);
    }


    public function sendSMS(string $sms_mobile, string $sms_message)
    {
        $sms_api_web = env('sms_api_web');
        $sms_api_v2 = env('sms_api_v2');
        $sms_username = env('sms_username');
        $sms_password = env('sms_password');
        $sms_language = env('sms_language');
        $sms_sender = env('sms_sender');
        return Http::post($sms_api_web."username=$sms_username&password=$sms_password&language=$sms_language&sender=$sms_sender&mobile=2$sms_mobile&message=$sms_message", []);

    }


}
