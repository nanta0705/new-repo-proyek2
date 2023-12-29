<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define("admin", function ($user) {
            if (empty($user->getAkses)) {
                return redirect("/logout");
            } else {
                return $user->getAkses->id == 1;
            }
        });
        Gate::define("owner", function ($user) {
            if (empty($user->getAkses)) {
                return redirect("/logout");
            } else {
                return $user->getAkses->id == 2;
            }
        });
        Gate::define("client", function ($user) {
            if (empty($user->getAkses)) {
                return redirect("/logout");
            } else {
                return $user->getAkses->id == 3;
            }
        });
    }
}
