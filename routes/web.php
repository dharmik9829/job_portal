<?php

use App\Models\Listings;
use Illuminate\Http\Request;
use function PHPSTORM_META\map;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

Route::get('/', [ListingController::class, 'index']);

// show create form
Route::get('/listing/create', [ListingController::class, "create"])->middleware('auth');

// store listing data
Route::post('/listings', [ListingController::class, "store"])->middleware('auth');

// manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// show edit form 
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listings
Route::delete('/listings/{listing}', [ListingController::class, 'delete'])->middleware('auth');

// single listing 
Route::get('/listing/{listing}', [ListingController::class, 'show']);

// Register new user view
Route::get('/register', [UserController::class, 'register']);

// store new user into database
Route::post('/users', [UserController::class, 'store']);

// logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// show login form
Route::get('/login', [UserController::class, 'login'])->name('login');

// login user
Route::post('/users/authenticate',  [UserController::class, 'authenticate']);
