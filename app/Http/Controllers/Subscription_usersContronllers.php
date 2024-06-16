<?php

namespace App\Http\Controllers;


use App\Models\Subscription;

use App\Models\SubscriptionUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Subscription_usersContronllers extends Controller
{
    public function cancelSubscription($id)
    {
        $plans = SubscriptionUser::findOrFail($id);
        $plans->delete();

        return redirect()->route('subscriptions.show')->with('success', 'Subscription cancel successfully.');

    }

    public function show()
    {
        $plans = SubscriptionUser::orderBy('id','desc')->get();
        $subscriptions = Subscription::all();
        $users = User::all();
        return view('subscriptions.show', compact('plans','subscriptions','users'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscription_id'=>'required',
            'user_id'=>'required',
        ]);
        $subscription = Subscription::findOrFail($request->subscription_id);

        // Initialize the end date
        $endDate = now();

        if ($subscription->subscription_type == 'month') {
            $endDate->addMonth();
        } elseif ($subscription->subscription_type == 'day') {
            $endDate->addDays(30); // For a one-month subscription in days
        } elseif ($subscription->subscription_type == 'year') {
            $endDate->addYear();
        }

        if ($validator->fails()) {
            return redirect()
                ->route('subscriptions.show')
                ->withErrors($validator)
                ->withInput();
        }else{
            SubscriptionUser::create([
                'subscription_id'=>$request->subscription_id,
                'user_id'=>$request->user_id,
                'end_date'=>$endDate,
            ]);

            return redirect()->route('subscriptions.show')->with('success','Subscription successfully.');
        }

    }
    public function edit($id)
    {
        $plans = SubscriptionUser::findOrFail($id);
        $subscriptions = Subscription::all();
        $users = User::all();
        return view('subscriptions.change', compact('plans','subscriptions','users'));
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($request->subscription_id);


        $endDate = now();

        if ($subscription->subscription_type == 'month') {
            $endDate->addMonth();
        } elseif ($subscription->subscription_type == 'day') {
            $endDate->addDays(30); // For a one-month subscription in days
        } elseif ($subscription->subscription_type == 'year') {
            $endDate->addYear();
        }
        $validator = Validator::make($request->all(), [
            'subscription_id'=>'required',
            'user_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect("/subscriptions/$id/change")
                ->withErrors($validator)
                ->withInput();

        } else {
            $plans=SubscriptionUser::findOrFail($id);
            $plans->update([
                'subscription_id'=>$request->subscription_id,
                'user_id'=>$request->user_id,
                'end_date'=>$endDate,
            ]);

            return redirect()->route('subscriptions.show')->with('success', 'Subscription change successfully.');
        }

    }
}
