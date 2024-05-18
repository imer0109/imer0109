<?php

use App\Models\Commande;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Unique;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $users = Commande::all()->each(function( $user) {
        $user->update(['slug' => uniqid()]);
    });
    return $users;
});
