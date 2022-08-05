<?php

namespace App\Providers;

use App\Services\Pwned;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Validator::extend('pwned', Pwned::class);
        Passport::withCookieSerialization();
        Passport::cookie(config('auth.passport.cookie', env('PASSPORT_COOKIE', 'workice_crm_token')));
        Passport::routes();
    }
}
