<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

use App\Utilities\GenericUtilities as GU;
use App\Services\GenericServices as GS;

// Fixed Route for all new application that will use Auth
Route::get('/app-login/{id}', [AuthenticationController::class, 'app_login'])->name('app.login');
// Login Route
Route::get('/login', [LoginController::class, 'login'])->name('login');
// Auth Middleware Group
Route::middleware(['auth', 'cors'])->group(function() {
	// Main Session Check for Authetication
	Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
	// Dash/Dashboard
	Route::get('/', [DashboardController::class, 'dash'])->name('dash');

	/**
	 * YOUR CODE STARTS HERE
	 * DO NOT ALTER ABOVE CODE
	 */

    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Show the users Blade view
    Route::get('/users/json', [UserController::class, 'userJson'])->name('users.json'); // Return JSON data
    Route::get('/users/grant-access/{id}/{role}', [UserController::class, 'grantAccess'])->name('grant.access');




    // Route::get('/admin', function () {
    //     return view('admin.admin_UI');
    // });

    Route::get('/home', function () {
        return view('hatchery.main_module');
    });

    Route::get('/egg-collection-entry', function () {
        return view('hatchery.egg_collection');
    });

    Route::get('/egg-temperature-check-entry', function () {
        return view('hatchery.egg_temperature');
    });

    Route::get('/rejected-hatch', function () {
        return view('hatchery.rejected_hatch');
    });

    Route::get('/rejected-pullets', function () {
        return view('hatchery.rejected_pullets');
    });

    Route::get('/master-database', function () {
        return view('hatchery.master_database');
    });
});

// Route::get('/gs', function () {
// 	return GS::service1();
// });

