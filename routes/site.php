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

        Route::get('news/{id}', [MainController::class, 'new'])->name('new');
        Route::post('news/{id}/like', [MainController::class, 'newLike'])->name('new.like');
        Route::get('news', [MainController::class, 'news'])->name('news');
        Route::get('articles/{id}', [MainController::class, 'article'])->name('article');
        Route::post('articles/{id}/like', [MainController::class, 'articleLike'])->name('article.like');
        Route::get('articles', [MainController::class, 'articles'])->name('articles');
        // Route::get('contact', [MainController::class, 'contact'])->name('contact');
        Route::post('comment', [MainController::class, 'comment'])->name('comment');
        Route::get('/contact', [MainController::class, 'contact'])->name('contact');
        Route::post('/contact', [MainController::class, 'contact_data'])->name('contactdata');
        Route::post('/addEmail', [MainController::class, 'addEmail'])->name('addEmail');
        Route::get('/send-mail', [MainController::class, 'send'])->name('sendmail');

        Route::get('publisher/{id}/news', [PublisherHomeController::class, 'publisherNews'])->name('publisherNews');
    });

    // Main Routes
    Route::get('/dashboard', function () {
        return redirect()->route('dashboard.home');
    })->middleware('auth:admin');

    Route::get('/publisher', function () {
        return redirect()->route('publisher.home');
    });
});
