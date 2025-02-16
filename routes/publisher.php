<?php

use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::prefix('publishers')->name('publishers.')->middleware('auth:publisher','check_user')->group(function() {
        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::get('/setting',[SettingController::class , 'index'])->name('setting.index');
        Route::post('/setting/update',[SettingController::class , 'update'])->name('setting.update');
    });
});
