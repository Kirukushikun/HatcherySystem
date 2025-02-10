<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/encrypt-id', function (Request $request) {
    try {
        $encryptedId = Crypt::encrypt($request->targetID);
        return response()->json(['encrypted_id' => $encryptedId]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Encryption failed'], 400);
    }
});