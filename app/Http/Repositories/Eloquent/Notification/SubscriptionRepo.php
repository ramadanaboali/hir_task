<?php

namespace App\Http\Repositories\Eloquent\Provider;

use App\Http\Repositories\Eloquent\AbstractRepo;
use App\Http\Repositories\Interfaces\Provider\SubscriptionRepoInterface;
use App\Models\Package;
use App\Models\Subscription;
use Carbon\Carbon;


class SubscriptionRepo extends AbstractRepo implements SubscriptionRepoInterface
{
    public function __construct()
    {
        parent::__construct(Subscription::class);
    }


    public function checkPromoCode(string $promocode,int $package_id,string $user_id)
    {
        $package=Package::findOrFail($package_id);
        $subscription=Subscription::where('promocode',$promocode)->where('user_id','!=',$user_id)->where('active',true)->where('end_date', '>=',Carbon::now())->first();
        if(!$subscription){
            return  false;
        }
        $primaryPackage=Package::findOrFail($subscription->package_id);
        if(    $primaryPackage->priceBeforeDiscount > $package->priceBeforeDiscount
            || $primaryPackage->priceAfterDiscount > $package->priceAfterDiscount
            || $primaryPackage->discountPercentage > $package->discountPercentage
            || $primaryPackage->couponValue > $package->couponValue
            ){
            return false;
        }
        $subscriptionPointsCount=Subscription::where('parent_subscription_id',$subscription->id)->where('active',true)->count();
        if($subscriptionPointsCount < $package->points){
            return true;
        }else{
            return false;
        }

    }

    public function getSubscriptionFromPromoCode(string $promocode)
    {
        return Subscription::where('promocode',$promocode)->first();
    }

    public  function generateRandomString($length = 20) {
//        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function checkSubscription(string $user_id, int $package_id)
    {
        $subscription=Subscription::where('user_id',$user_id)->where('package_id',$package_id)->where('end_date', '>=',Carbon::now())->first();
        if($subscription){
            return true;
        }else{
            return false;
        }
    }
}
