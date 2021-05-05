<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('clients.registration');
});

Route::get('/clients', [RegistrationController::class, 'index']);
Route::get('/client/{client}', [RegistrationController::class, 'show']);
Route::patch('/update/client/{client}', [RegistrationController::class, 'update']);
Route::post('/store/information', [RegistrationController::class, 'store']);
Route::delete('/delete/{client}', [RegistrationController::class, 'delete']);
Route::get('/skills', [SkillController::class, 'index']);

