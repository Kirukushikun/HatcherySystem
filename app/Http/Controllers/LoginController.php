<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
        if(Auth::check()) {
            return redirect()->route('dash');
        }
        return view('login');
    }


    public function logout()
    {
        if(Auth::check()) {
	    	Auth::logout();
        }
    	return view('logout');
    }
}
