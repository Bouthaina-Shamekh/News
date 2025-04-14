<?php

use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Dashboard\AdController;
use App\Http\Controllers\Dashboard\NwController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\AboutController;
use App\Http\Controllers\Dashboard\StatusController;
use App\Http\Controllers\Dashboard\AdPlaceController;
use App\Http\Controllers\Dashboard\ArticalController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\MessageController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ConstantController;
use App\Http\Controllers\Dashboard\NewPlaceController;
use App\Http\Controllers\Dashboard\PublisherController;
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

// Route::get('/', [MainController::class, 'home'])->name('site.index');
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::prefix('dashboard')->name('dashboard.')->middleware('auth:admin','check_user')->group(function() {
        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::get('messages', [MessageController::class, 'index'])->name('messages');
        Route::post('/track-visit', [HomeController::class, 'storeVisit'])->name('track_visit');

        Route::get('users/{user}/profile', [UserController::class, 'profile'])->name('users.profile');

        Route::resources([
            'users' => UserController::class,
            'category' => CategoryController::class,
            'articale' => ArticalController::class,
            'ad' => AdController::class,
            'tag' => TagController::class,
            'nw' => NwController::class,
            'publisher' => PublisherController::class,
            'comment' => CommentController::class,
            'message' => MessageController::class,
            'adplace' => AdPlaceController::class,
            'newplace' =>NewPlaceController::class,
            'status' => StatusController::class,
        ]);



        Route::get('/about/{id}/edit', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('/about/{id}', [AboutController::class, 'update'])->name('about.update');

        Route::get('/setting',[SettingController::class , 'index'])->name('setting.index');
        Route::post('/setting/update',[SettingController::class , 'update'])->name('setting.update');

        Route::get('/constant',[SettingController::class , 'index'])->name('constant.index');
        Route::post('/constant/update',[ConstantController::class , 'update'])->name('constant.update');
    });
});

