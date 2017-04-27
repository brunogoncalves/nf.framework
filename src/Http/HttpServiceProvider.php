<?php namespace NetForce\Framework\Http;

use Illuminate\Support\ServiceProvider;

class HttpServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register Http
        $this->app->singleton('api-helper', '\NetForce\Framework\Http\Api');
    }
}
