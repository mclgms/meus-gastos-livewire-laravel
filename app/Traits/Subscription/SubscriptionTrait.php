<?php


namespace App\Traits\Subscription;


trait SubscriptionTrait
{

    public function loadFeaturesByUserPlan($type = null)
    {
        $userPlan = auth()->user()->plan->plan;
        return $userPlan->features()->whereType($type)->get();
    }

}
