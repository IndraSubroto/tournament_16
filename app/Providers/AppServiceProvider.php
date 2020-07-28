<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('isAdmin',function($user){
            return $user->role_id == '1';
        });
        Gate::define('isPromotor',function($user){
            return $user->role_id == '2';
        });
        Gate::define('isMember',function($user){
            return $user->role_id == '3';
        });

        Blade::directive('money', function ($money) {
            return "<?php echo number_format($money, 0); ?>";
        });
        
        Blade::directive('created_at', function ($date) {
            return "<?php echo date_format($date,'d M y - h : i : s'); ?>";
        });
        
        Blade::directive('date', function ($date) {
            return "<?php echo date('d M Y',strtotime($date)); ?>";
        });
    }
}
