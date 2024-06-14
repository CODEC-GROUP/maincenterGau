<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthContronllers extends Controller
{
    public function showFormResgiter(){
        return view('auth.register');
    }
    public function showFormLogin(){
        return view('auth.login');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('register')
                ->withErrors($validator)
                ->withInput();
        }else{
            User::create([
                'name'=>$request->nom,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            return redirect()->route('login');
        }
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('subscriptions.index');
        }

        return back()->withErrors([
            'email' => 'Identifiant incorrect.',
        ])->onlyInput('email');
    }
}
