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
Route::view('not_allowed', 'not_allowed');

// Website Routes
Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
    Route::group([
        'as' => 'site.',
    ],function(){
        Route::get('/', [MainController::class, 'home'])->name('index');
        Route::get('/about', [MainController::class, 'about'])->name('about');


        Route::get('/new', [MainController::class, 'home'])->name('new');
        Route::get('/news', [MainController::class, 'home'])->name('news');
        Route::get('/articles', [MainController::class, 'home'])->name('articles');
        Route::get('/contact', [MainController::class, 'contact'])->name('contact');
        Route::post('/contact', [MainController::class, 'contact_data'])->name('contactdata');
        Route::get('/send-mail', [MainController::class, 'send'])->name('sendmail');
       

    });


    // Main Routes
    Route::get('/dashboard', function () {
        return redirect()->route('dashboard.home');
    });
    Route::get('/publisher', function () {
        return redirect()->route('publishers.home');
    });
});
