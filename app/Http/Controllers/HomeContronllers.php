<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeContronllers extends Controller
{
    public function home(){
        $subscriptions = Subscription::all();
        $user = Auth::user();
        $plans = SubscriptionUser::where('user_id', $user->id)->get();
        return view('app.home', compact('subscriptions', 'plans', 'user'));
    }
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
