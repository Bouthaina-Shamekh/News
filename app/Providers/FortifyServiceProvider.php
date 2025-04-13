<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $request = request();
        $app_local = app()->getLocale();

        Config::set('fortify.prefix',$app_local);
        if($request->is($app_local . '/dashboard/*') || $request->is('dashboard') || $request->is($app_local . '/dashboard')){
            Config::set('fortify.guard','admin');
            Config::set('fortify.passwords','admins');
            Config::set('fortify.prefix',$app_local . '/dashboard');
            Config::set('fortify.home','/dashboard/home');
        }
        if($request->is($app_local . '/publisher/*') || $request->is('publisher') || $request->is($app_local . '/publisher')){
            Config::set('fortify.guard','publisher');
            Config::set('fortify.passwords','publishers');
            Config::set('fortify.prefix',$app_local . '/publisher');
            Config::set('fortify.home','/publisher/home');
        }

        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                if(Config::get('fortify.guard') == 'admin'){
                    return redirect()->intended('/dashboard/home');
                }
                if(Config::get('fortify.guard') == 'publisher'){
                    return redirect('/publisher/home');
                }
                return redirect()->intended('/');
            }
        });
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                if(Config::get('fortify.guard') == 'admin'){
                    return redirect()->intended(app()->getLocale() . '/dashboard/login');
                }
                if(Config::get('fortify.guard') == 'publisher'){
                    return redirect()->intended(app()->getLocale() . '/publisher/login');
                }
                return redirect('/');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::loginView(function () {
            if(Config::get('fortify.guard') == 'admin'){
                return view('auth.admins.login');
            }
            if(Config::get('fortify.guard') == 'publisher'){
                return view('auth.publishers.login');
            }
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}

