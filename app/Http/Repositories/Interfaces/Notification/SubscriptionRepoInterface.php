<?php

namespace App\Http\Repositories\Interfaces\Provider;
interface SubscriptionRepoInterface
{
    public function checkSubscription(string $user_id,int $package_id);
    public function checkPromoCode(string $promocode,int $package_id,string $user_id);
    public function getSubscriptionFromPromoCode(string $promocode);
    public function generateRandomString(int $length);
}
