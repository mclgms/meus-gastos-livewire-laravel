<?php


namespace App\Traits\Subscription;


trait SubscriptionTrait
{

    public function loadFeaturesByUserPlan($type = null)
    {
        //$userPlan = auth()->user()->plan->plan;
        $userPlan = auth()->user()->plan();
        if (!$userPlan) return [];

        return $userPlan->first()->plan->features()->whereType($type)->get();
    }

    public function userCanCreateNewExpense()
    {
        $amountFeature = $this->loadFeaturesByUserPlan('amount');
        // realizar checagem de quantidade
        $amount = auth()->user()->expenses->count();
        return $amount >= 10;
    }

}
