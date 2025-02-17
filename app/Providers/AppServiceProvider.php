<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('abilities', function() {
            return include base_path('data/abilities.php');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);


        $locale = LaravelLocalization::getCurrentLocale(); // اللغة الحالية من المكتبة
    if (!$locale) {
        LaravelLocalization::setLocale('ar');
    } 

        View::share('name', 'name_' . app()->currentLocale());
        View::share('title', 'title_' . app()->currentLocale());
        View::share('description', 'description_' . app()->currentLocale());
        View::share('file_name', 'file_name_' . app()->currentLocale());
        View::share('feedback', 'feedback_' . app()->currentLocale());
        View::share('Specialization', 'Specialization_' . app()->currentLocale());
        View::share('feature', 'feature_' . app()->currentLocale());
        View::share('about', 'about_' . app()->currentLocale());
        View::share('objective', 'objective_' . app()->currentLocale());
        View::share('mission', 'mission_' . app()->currentLocale());
        View::share('vission', 'vission_' . app()->currentLocale());
        View::share('goal', 'goal_' . app()->currentLocale());

        //Authouration
        Gate::before(function ($user, $ability) {
            if($user instanceof User) {
                if($user->super_admin) {
                    return true;
                }
            }
        });
        // // the Authorization for Report Page
       

    }
}
