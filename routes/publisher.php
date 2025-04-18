<?php

use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Publisher\HomeController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Publisher\ArticalController;
use App\Http\Controllers\Publisher\NwController;
use App\Http\Middleware\CheckStatusPublisher;
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
    Route::get('publisher/non-active', [HomeController::class, 'non_active'])->middleware('auth:publisherGuard')->name('publisher.non-active');
    Route::prefix('publisher')->name('publisher.')->middleware('auth:publisherGuard','check_user',CheckStatusPublisher::class)->group(function() {
        Route::get('home', [HomeController::class, 'index'])->name('home');

        Route::resources([
            'articale' => ArticalController::class,
            'nw' => NwController::class,
        ]);

        Route::get('/acceptnews',[HomeController::class , 'acceptnews'])->name('acceptnews');
        Route::get('/waitnews',[HomeController::class , 'waitnews'])->name('waitnews');
        Route::post('/setting/update',[SettingController::class , 'update'])->name('setting.update');

        // Route::get('/login', function () {
        //     return view('auth.publishers.login'); // صفحة تسجيل الدخول الخاصة بالناشر
        // })->name('login');
        // Route::get('/register', function () {
        //     return view('auth.publishers.register'); // صفحة تسجيل الدخول الخاصة بالناشر
        // })->name('register');
    });
});
