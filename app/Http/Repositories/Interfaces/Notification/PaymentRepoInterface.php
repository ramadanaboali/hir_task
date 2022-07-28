<?php

namespace App\Http\Repositories\Interfaces\Provider;
interface PaymentRepoInterface
{
    public function sendSMS(string $sms_mobile,string $sms_message);
}
