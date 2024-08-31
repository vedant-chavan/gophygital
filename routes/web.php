<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserRegistrationController;
use App\Http\Controllers\User\UserLoginController;
use Faker\Guesser\Name;

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
    return view('welcome');
});

Route::get('/user_reg',[UserRegistrationController::class,'show']);
Route::post('/register_user',[UserRegistrationController::class,'registerUserData']);
Route::get('/verify_email/{id}', [UserRegistrationController::class, 'verifyEmail'])->name('verify_email');

Route::get('/login',[UserLoginController::class,'login'])->name('login');
Route::post('/user_login',[UserLoginController::class,'userLogin']);

Route::get('/user_details', [UserLoginController::class, 'showUserDetails']);

Route::post('/user/update-status', [UserLoginController::class, 'updateStatus']);
Route::get('/details',[UserLoginController::class,'details']);
Route::post('/user/fetch-details', [UserLoginController::class, 'fetchDetails']);
