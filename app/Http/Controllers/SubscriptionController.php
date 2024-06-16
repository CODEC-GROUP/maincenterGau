<?php

namespace App\Http\Controllers;


use App\Models\Subscription;

use App\Models\SubscriptionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::orderBy('id','desc')->get();
        return view('subscriptions.index', compact('subscriptions'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:60',
            'montant'=>'required|numeric',
            'desc'=>'required|string|max:255',
            'subscription_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('subscriptions.index')
                ->withErrors($validator)
                ->withInput();
        }else{
            Subscription::create([
                'name'=>$request->name,
                'desc'=>$request->desc,
                'montant'=>$request->montant,
                'subscription_type' =>$request->subscription_type,
            ]);

            return back()->with('success','Subscription created successfully.');
        }

    }


    public function edit($id)
    {
        $subscriptions = Subscription::findOrFail($id);
        return view('subscriptions.edit', compact('subscriptions'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:50',
            'desc'=>'required|string|max:255',
            'montant'=>'required|numeric',
            'subscription_type' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect("subscriptions/$id/edit")
                ->withErrors($validator)
                ->withInput();

        } else {
            $subscriptions=Subscription::findOrFail($id);
            $subscriptions->update([
                'name'=>$request->name,
                'desc'=>$request->desc,
                'montant'=>$request->montant,
                'subscription_type' =>$request->subscription_type,
            ]);

        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully.');
       }

    }

    public function destroy($id)
    {
        $subscriptions = Subscription::findOrFail($id);
        $subscriptions->delete();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription deleted successfully.');

    }
    public function makeSubscription($id)
    {
        $subscriptions = Subscription::findOrFail($id);
        return view('subscriptions.make', compact('subscriptions'));
    }
    public function storeSubscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscription_id'=>'required',

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
            return redirect("/subscriptions/make/{id}")
                ->withErrors($validator)
                ->withInput();

        } else {
            SubscriptionUser::create([
                'subscription_id'=>$request->subscription_id,
                'user_id'=>Auth::user()->id,
                'end_date'=>$endDate,
            ]);


            return redirect()->route('home')->with('success', 'Subscription successfully.');
        }

    }

    public function editForm($id)
    {
        $plans = SubscriptionUser::findOrFail($id);
        $subscriptions = Subscription::all();
        return view('subscriptions.changeU', compact('subscriptions','plans'));
    }
    public function updateForm(Request $request , $id)
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

        ]);
        if ($validator->fails()) {
            return redirect("/subscriptions/$id/changeU")
                ->withErrors($validator)
                ->withInput();

        } else {
            $plans=SubscriptionUser::findOrFail($id);
            $plans->update([
                'subscription_id'=>$request->subscription_id,
                'end_date'=>$endDate,
            ]);

            return redirect()->route('home')->with('success', 'Subscription change successfully');
        }

    }



}
