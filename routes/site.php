<?php

use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Publisher\HomeController as PublisherHomeController;
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
Route::get('/', function () {
    // هذا يحول / إلى /ar تلقائيًا بناءً على اللغة الافتراضية
    return redirect(LaravelLocalization::getLocalizedURL('ar'));
});

// Website Routes
Route::group([
    'prefix' => LaravelLocalization::setLocale()

], function(){
    Route::group([
        'as' => 'site.',
    ],function(){
        Route::get('/', [MainController::class, 'home'])->name('index');


        Route::get('/about', [MainController::class, 'about'])->name('about');

        Route::get('news/{new}', [MainController::class, 'new'])->name('new');
        Route::post('news/{new}/like', [MainController::class, 'newLike'])->name('new.like');
        Route::get('news', [MainController::class, 'news'])->name('news');
        Route::get('articles/{article}', [MainController::class, 'article'])->name('article');
        Route::post('articles/{article}/like', [MainController::class, 'articleLike'])->name('article.like');
        Route::get('articles', [MainController::class, 'articles'])->name('articles');
        // Route::get('contact', [MainController::class, 'contact'])->name('contact');
        Route::post('comment', [MainController::class, 'comment'])->name('comment');
        Route::get('/contact', [MainController::class, 'contact'])->name('contact');
        Route::post('/contact', [MainController::class, 'contact_data'])->name('contactdata');
        Route::post('/addEmail', [MainController::class, 'addEmail'])->name('addEmail');
        Route::get('/send-mail', [MainController::class, 'send'])->name('sendmail');

        Route::get('publisher/{id}/news', [PublisherHomeController::class, 'publisherNews'])->name('publisherNews');
        Route::get('publisher/{id}/profile', [PublisherHomeController::class, 'publisher'])->name('publisher');

    });
    Route::get('forgot-password', [PublisherHomeController::class, 'forgot_password'])->middleware('guest')->name('publisher.forgot_password');
    Route::post('forgot-password', [PublisherHomeController::class, 'forgot_password_store'])->middleware('guest')->name('publisher.forgot_password_store');
    Route::get('/reset-password/{token}', [PublisherHomeController::class, 'resetPasswordView'])->middleware('guest')->name('publisher.resetPassword');
    Route::post('reset-password', [PublisherHomeController::class, 'resetPassword'])->middleware('guest')->name('publisher.resetPassword');

    // Main Routes
    Route::get('/dashboard', function () {
        return redirect()->route('dashboard.home');
    })->middleware('auth:admin');

    Route::get('/publisher', function () {
        return redirect()->route('publisher.home');
    });
});
