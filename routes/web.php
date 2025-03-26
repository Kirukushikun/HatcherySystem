<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\EggCollectionController;
use App\Http\Controllers\EggTemperatureController;
use App\Http\Controllers\RejectedHatchController;
use App\Http\Controllers\RejectedPulletsController;
use App\Http\Controllers\MasterDatabaseController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AdminController;


use App\Http\Livewire\EggCollectionTable;
use App\Http\Livewire\EggTemperatureTable;
use App\Http\Livewire\RejectedHatchTable;
use App\Http\Livewire\RejectedPulletsTable;
use App\Http\Livewire\MaintenanceValueTable;
use App\Http\Livewire\AuditTrailTable;
use App\Http\Livewire\MasterDatabaseTable;


use App\Http\Controllers\EditController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ReportController;

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
    Route::get('/users/grant-access/{id}/{role}/{action}', [UserController::class, 'grantAccess'])->name('grant.access');
    Route::get('/users/persons', [UserController::class, 'index2'])->name('users.index2'); // Show the users Blade view

    Route::get('/gs', function () {
        return GS::service1();
    });

    Route::get('/access', [UserController::class, 'accessLogs'])->name('access.logs');
    Route::get('/access/access-logs-json', [UserController::class, 'accessLogsJson'])->name('access-logs.json');

});

Route::get('/admin', function () {
    return view('admin.admin_UI');
});

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

// Rejected Hatch -------------------------------------------------------------------------------------------

Route::get('/fetch-rejected-hatch-data', [RejectedHatchTable::class, 'fetchData'])->name('rejected.hatch.fetch'); // Rejected Hatch Table Data Fetch

Route::get('/rejected-hatch', [RejectedHatchController::class, 'rejected_hatch_index'])->name('rejected.hatch.index'); // View

Route::post('/rejected-hatch/store', [RejectedHatchController::class, 'rejected_hatch_store'])->name('rejected.hatch.store'); // Store

Route::patch('/rejected-hatch/delete/{targetID}', [RejectedHatchController::class, 'rejected_hatch_delete'])->name('rejected.hatch.delete'); // Delete

// Rejected Pullets -------------------------------------------------------------------------------------------

Route::get('/fetch-rejected-pullets-data', [RejectedPulletsTable::class, 'fetchData'])->name('rejected.pullets.fetch'); // Rejected Pullets Table Data Fetch

Route::get('/rejected-pullets', [RejectedPulletsController::class, 'rejected_pullets_index'])->name('rejected.pullets.index'); // View

Route::post('/rejected-pullets/store', [RejectedPulletsController::class, 'rejected_pullets_store'])->name('rejected.pullets.store'); // Store

Route::patch('/rejected-pullets/delete/{targetID}', [RejectedPulletsController::class, 'rejected_pullets_delete'])->name('rejected.pullets.delete'); // Delete
  

// Admin Maintenance -------------------------------------------------------------------------------------------

Route::get('/fetch-maintenance-value-data', [MaintenanceValueTable::class, 'fetchData'])->name('maintenance.value.fetch'); // Maintenance Value Table Data Fetch

Route::post('/maintenance/store', [AdminController::class, 'update_module_store'])->name('maintenance.store'); // Store

Route::delete('/maintenance/delete/{targetID}', [AdminController::class, 'update_module_delete'])->name('maintenance.delete'); // Delete

//Audit Trail

Route::get('/fetch-audit-trail-data', [AuditTrailTable::class, 'fetchData'])->name('audit.trail.fetch'); // View

Route::get('/fetch-audit-data/{targetID}', [AuditController::class, 'fetchAuditData'])->name('audit.trail.data'); // Fetch Target ID Data

Route::delete('/audit/delete/{targetID}', [AuditController::class, 'audit_trail_delete'])->name('audit.delete'); // Delete

// Edit ---------

Route::get('/{targetForm}/edit/{targetID}', [EditController::class, 'edit_record_index'])->name('edit.record.index'); // Edit View

Route::patch('/{targetForm}/edit/{targetID}', [EditController::class, 'edit_record_update'])->name('edit.record.update'); // Update

// Report ---------

Route::get('/{targetForm}/report', [ReportController::class, 'generateReport']);

Route::post('/egg-collection/report/result', [ReportController::class, 'egg_collection_result']);

// PDF ---------

Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);

Route::get('/test', function () {
	return view('hatchery.report_module');
});

Route::get('/fetch-master-database-data', [MasterDatabaseTable::class, 'fetchData'])->name('master.database.fetch');

Route::get('/master-database', [MasterDatabaseController::class, 'master_database_index'])->name('master.database.index');
Route::get('/master-database/data-check/{batchNumber}/{currentStep}', [MasterDatabaseController::class, 'master_database_check'])->name('master.database.check');

Route::post('/master-database/store', [MasterDatabaseController::class, 'master_database_store'])->name('master.database.store');
Route::patch('/master-database/delete/{targetBatch}', [MasterDatabaseController::class, 'master_database_delete'])->name('master.database.delete');
Route::get('/master-database/view/{targetBatch}', [MasterDatabaseController::class, 'master_database_view'])->name('master.database.view');

