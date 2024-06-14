<?php

namespace App\Http\Controllers;


use App\Models\Subscription;
use App\Models\Subscription_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Subscription_usersContronllers extends Controller
{
    public function cancelSubscription($id)
    {
        $plans = Subscription_User::findOrFail($id);
        $plans->delete();

        return redirect()->route('subscriptions.show')->with('success', 'Subscription cancel successfully.');

    }

    public function show()
    {
        $plans = Subscription_User::orderBy('id','desc')->get();
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

        if ($validator->fails()) {
            return redirect()
                ->route('subscriptions.show')
                ->withErrors($validator)
                ->withInput();
        }else{
            Subscription_User::create([
                'subscription_id'=>$request->subscription_id,
                'user_id'=>$request->user_id,
            ]);

            return redirect()->route('subscriptions.show')->with('success','Subscription successfully.');
        }

    }
    public function edit($id)
    {
        $plans = Subscription_User::findOrFail($id);
        $subscriptions = Subscription::all();
        $users = User::all();
        return view('subscriptions.change', compact('plans','subscriptions','users'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subscription_id'=>'required',
            'user_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect("/subscriptions/$id/change")
                ->withErrors($validator)
                ->withInput();

        } else {
            $plans=Subscription_User::findOrFail($id);
            $plans->update([
                'subscription_id'=>$request->subscription_id,
                'user_id'=>$request->user_id,
            ]);

            return redirect()->route('subscriptions.show')->with('success', 'Subscription change successfully.');
        }

    }
}
