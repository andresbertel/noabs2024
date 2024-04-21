<?php

namespace App\Providers;





use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

      // dd(Auth::user());


    Gate::define('isAdmin', function ($user) {




        if(empty($user->admin->first()->exists)){

            return false;
        }

        return true;
    });

    Gate::define('isGestor', function ($user) {


        if(empty($user->admin->first()->exists) and empty($user->gestor->first()->exists)){

            return false;
        }

        return true;
    });

    Gate::define('isNino', function ($user) {


        if(empty($user->nino->first()->exists)){

            return false;
        }

        return true;
    });
}



        //

}
