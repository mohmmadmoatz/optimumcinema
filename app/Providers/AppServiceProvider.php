<?php

namespace App\Providers;
use Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Artisan;
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
        //
       


        Blade::directive('convert', function ($ip) {
          
            
            return "<?php echo str_replace('93.191.114.168','10.24.24.206',$ip) ?>";
        });
		Schema::defaultStringLength(191);
    }
}
