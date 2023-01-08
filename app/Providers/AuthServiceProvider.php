<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Log;
use App\Models\Logbook;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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

        Gate::define('modify-logbook', function (User $user, Logbook $logbook) {
            return $user->id === $logbook->user->id;
        });

        Gate::define('modify-log', function (User $user, Logbook $logbook, Log $log) {
            return $user->id === $logbook->user->id && $logbook->id == $log->logbook->id;
        });
    }
}
