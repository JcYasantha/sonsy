<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        

        Gate::define('isAdmin',function($user){
            return $user->type === 'Admin'; 
        });
        Gate::define('isAccountant',function($user){
            return $user->type === 'Accountant'; 
        });
        Gate::define('isCashier',function($user){
            return $user->type === 'Cashier'; 
        });
        Gate::define('isStockKeeper',function($user){
            return $user->type === 'StockKeeper'; 
        });
        Gate::define('isadminorStockKeeper',function($user){
            if($user->type == 'Admin'){
                return $user->type === 'Admin'; 
            }
            else if($user->type == 'StockKeeper'){
                return $user->type === 'StockKeeper'; 
            }
        });
        Gate::define('isadminorCashier',function($user){
            if($user->type == 'Admin'){
                return $user->type === 'Admin'; 
            }
            else if($user->type == 'Cashier'){
                return $user->type === 'Cashier'; 
            }
        });
        Passport::routes();
        //
    }
}
