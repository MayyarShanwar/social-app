<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function register(Request $req){
    //     dd($req->username); //show th username from the request
    //     dd($req);  //show the full request
    // }

    public function register(Request $req){
        $user = $req->validate([
            'username' => ['required' , 'max:255'],
            'email' => ['required', 'max:255' , 'email','unique:users'], //we put the unique so the error shows in front normaly
            'password' => ['required', 'min:3', 'confirmed']
        ]);
        //laravel automatically hash the password for better security
        $created_user = User::create($user);

        //log in
        Auth::login($created_user);
        return redirect('/');

        dd('ok');
    }


    //Log in Users
    public function login(Request $req) {
        $user = $req->validate([
            'email' => ['required', 'max:255' , 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($user,$req->remember)){
            return redirect()->intended('dashboard');
        }
        else{return back()->withErrors([
                'failed' => 'The email or password is wrong ,Try again later'
            ]);
        }
    }

    public function logout(Request $req){
        Auth::logout();
        //end the session
        $req->session()->invalidate();
        //delete csrf
        $req->session()->regenerateToken();

        return redirect('/');
    }
}
