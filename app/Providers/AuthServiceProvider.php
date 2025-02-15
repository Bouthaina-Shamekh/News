<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //  'App\Models\Model' => 'App\Policies\ModelPolicy',
        //  'App\Models\About' => 'App\Policies\ModelPolicy',
        //  'App\Models\AdPlace' => 'App\Policies\ModelPolicy',
        //  'App\Models\Ad' => 'App\Policies\ModelPolicy',
        //  'App\Models\Artical' => 'App\Policies\ModelPolicy',
        //  'App\Models\Category' => 'App\Policies\ModelPolicy',
        //  'App\Models\NewPlace' => 'App\Policies\ModelPolicy',
        //  'App\Models\Nw' => 'App\Policies\ModelPolicy',
        //  'App\Models\Publisher' => 'App\Policies\ModelPolicy',
        //  'App\Models\Setting' => 'App\Policies\ModelPolicy',
        //  'App\Models\Statu' => 'App\Policies\ModelPolicy',
        //  'App\Models\User' => 'App\Policies\ModelPolicy',
        
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
