<?php

use App\Http\Controllers\Api\CommandeApiController;
use App\Http\Controllers\Api\StudentApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// index, store, get, update, delete

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(StudentApiController::class)->prefix('students')->group(function () {
    Route::get('liste', 'index');
    Route::post('create', 'store');
    Route::get('{id}', 'show');
    Route::put('{id}', 'update');
    Route::delete('{id}', 'destroy');
    Route::get('avec-commandes', 'withCommandes');
});

Route::controller(CommandeApiController::class)->prefix('commandes')->group(function () {
    Route::get('liste', 'index');
    Route::post('', 'store');
    Route::get('{id}', 'show');
    Route::put('{id}', 'update');
    Route::delete('{id}', 'destroy');
    Route::get('avec-etudiant', 'withStudents');
});

