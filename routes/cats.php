<?php

use App\Admin\Cats\Controllers\BreedController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| cats Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for cats. These
| routes needs to be added to the RouteServiceProvider.
| Now create something great!
|
*/

// Breed
Route::resource('breed', BreedController::class);
