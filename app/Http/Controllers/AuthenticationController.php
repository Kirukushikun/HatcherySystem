<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Auth;
use App\Http\Controllers\GeneralController as GC;
use App\Http\Controllers\UserController as AC;

class AuthenticationController extends Controller
{

    public function app_login($id = null)
    {
        if(Auth::check()) {
            // Already logged in
            AC::accessLogEntry(Auth::user()->id);
            return redirect()->route('dash');
        }

    	$id = GC::decryptString($id);

    	// Check user if registered to access this system
    	$user = User::whereId($id)->first();

    	if(isset($user)) {

    		if(Auth::loginUsingId($user->id)) {
                // Login Success
                // Sessions For Current Users
                AC::accessLogEntry($user->id);
    			return redirect()->route('dash');
    		}
    		else {
                // Login Error
    			return "Login Error [1]. System Login Error";
    		}
    	}
    	else {
            // No Access to the system
    		return "Login Error [2]. No Access to the System";
    	}
    }
}
