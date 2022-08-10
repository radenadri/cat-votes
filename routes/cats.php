<?php

use App\Admin\Cats\Controllers\BreedController;
use App\Admin\Cats\Controllers\CatController;
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

Route::middleware(['auth', 'verified'])->group(function() {
    // Breed
    Route::resource('breed', BreedController::class);
    // Cat
    Route::resource('cat', CatController::class);
});
