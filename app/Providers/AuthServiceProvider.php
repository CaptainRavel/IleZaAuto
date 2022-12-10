<?php

namespace App\Providers;

use App\Enums\UserRole;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user) {
            return $user->role == UserRole::ADMIN;
        });
        Gate::define('isUser', function($user) {
            return $user->role == UserRole::USER;
        });   
        Gate::define('isPremiumUser', function($user) {
            return $user->role == UserRole::P_USER;
        });
        Gate::define('isTestUser', function($user) {
            return $user->role == UserRole::T_USER;
        });
        Gate::define('isVerifiedEmailUser', function($user) {
            return $user->is_email_verified == 1;
        });
        
    }
}
