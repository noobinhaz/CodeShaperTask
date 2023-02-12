<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashControl;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LikeController;
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

//user registration
Route::get('/register', [UserController::class, 'create']);

//create user
Route::post('/users', [UserController::class, 'store']);

//login form
Route::get('/login', [UserController::class, 'login'])->name('login');

//login users
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
//logout user
Route::post('/logout', [UserController::class, 'logout']);

//dashboard to logged in users
Route::get('/dashboard', [DashControl::class, 'dashboard']);

Route::get('/dashboard/posts', [DashControl::class ,'posts']);

Route::get('/dashboard/plans', [DashControl::class, 'showPlans']);

Route::get('/dashboard/changePlan', [PaymentController::class, 'paymentPage']);
Route::get('/dashboard/posts/{id}', [DashControl::class, 'show']);
Route::post('/dashboard/pay', [PaymentController::class, 'store']);

Route::get('/like/{id}', [LikeController::class, 'store']);

//posts
Route::resource('/posts', PostController::class)->except('index', 'update');

Route::post('/posts/{id}', [PostController::class, 'update']);

Route::get('/', [PostController::class, 'index']);
