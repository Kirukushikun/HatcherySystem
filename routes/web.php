<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EggCollectionController;
use App\Http\Controllers\EggTemperatureController;

use App\Http\Livewire\EggCollectionTable;
use App\Http\Livewire\EggTemperatureTable;

use App\Http\Controllers\EditController;

use App\Utilities\GenericUtilities as GU;
use App\Services\GenericServices as GS;

use App\Http\Controllers\PDFController;




// Fixed Route for all new application that will use Auth
Route::get('/app-login/{id}', [AuthenticationController::class, 'app_login'])->name('app.login');
// Login Route
Route::get('/login', [LoginController::class, 'login'])->name('login');
// Auth Middleware Group
Route::middleware('auth')->group(function() {
	// Main Session Check for Authetication
	Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
	// Dash/Dashboard
	Route::get('/', [DashboardController::class, 'dash'])->name('dash');

	/**
	 * YOUR CODE STARTS HERE
	 * DO NOT ALTER ABOVE CODE
	 */
});


Route::get('/gs', function () {
	return GS::service1();
});


Route::get('/admin', function () {
	return view('admin.admin_UI');
});

Route::get('/home', function () {
	return view('hatchery.main_module');
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


// Egg Collection -------------------------------------------------------------------------------------------

Route::get('/fetch-egg-collection-data', [EggCollectionTable::class, 'fetchData'])->name('egg.collection.fetch'); // Egg Collection Table Data Fetch

Route::get('egg-collection', [EggCollectionController::class, 'egg_collection_index'])->name('egg.collection.index'); // View

Route::post('/egg-collection/store', [EggCollectionController::class, 'egg_collection_store'])->name('egg.collection.store'); // Store

Route::patch('egg-collection/delete/{targetID}', [EggCollectionController::class, 'egg_collection_delete'])->name('egg.collection.delete'); // Delete

// Egg Temperature -------------------------------------------------------------------------------------------

Route::get('/fetch-egg-temperature-data', [EggTemperatureTable::class, 'fetchData'])->name('egg.temperature.fetch'); // Egg Temperature Table Data Fetch

Route::get('/egg-temperature', [EggTemperatureController::class, 'egg_temperature_index'])->name('egg.temperature.index'); // View

Route::post('/egg-temperature/store', [EggTemperatureController::class, 'egg_temperature_store'])->name('egg.temperature.store'); // Store

Route::patch('/egg-temperature/delete/{targetID}', [EggTemperatureController::class, 'egg_temperature_delete'])->name('egg.temperature.delete'); // Delete


// Edit ---------

Route::get('/{targetForm}/edit/{targetID}', [EditController::class, 'edit_record_index'])->name('edit.record.index'); // Edit View

Route::patch('/{targetForm}/edit/{targetID}', [EditController::class, 'edit_record_update'])->name('edit.record.update'); // Update

Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);