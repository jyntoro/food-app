<?php

use App\Http\Controllers\FavoriteMealController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::view('/about', 'about')->name('about');

Route::get('/login', [AuthController::class,'loginForm'])->name('auth.loginForm');
Route::post('/login', [AuthController::class,'login'])->name('auth.login');

Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

Route::middleware(['custom-auth'])->group(function (){
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/meals', [MealController::class, 'index'])->name('meal.index');

    Route::get('/meals/create', [MealController::class, 'create'])->name('meal.create');
    Route::post('/meals', [MealController::class, 'store'])->name('meal.store');

    Route::get('/meals/{id}/edit', [MealController::class, 'edit'])->name('meal.edit');
    Route::post('/meals/{id}', [MealController::class, 'update'])->name('meal.update');

    Route::get('/meals/{id}/delete', [MealController::class, 'deleteForm'])->name('meal.deleteForm');
    Route::post('/meals/{id}/delete', [MealController::class, 'delete'])->name('meal.delete');

    Route::get('/favorites', [FavoriteMealController::class, 'index'])->name('favorite.index');
    Route::get('/favorites/{id}', [FavoriteMealController::class, 'create'])->name('favorite.create');
    Route::post('/favorites/{id}', [FavoriteMealController::class, 'store'])->name('favorite.store');

    Route::get('/favorites/{id}/delete', [FavoriteMealController::class, 'deleteForm'])->name('favorite.deleteForm');
    Route::post('/favorites/{id}/delete', [FavoriteMealController::class, 'delete'])->name('favorite.delete');
});
