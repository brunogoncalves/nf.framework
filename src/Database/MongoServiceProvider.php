<?php namespace NetForce\Framework\Database;

use Illuminate\Support\ServiceProvider;

class MongoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register mongodb driver
        db()->extend('mongodb', function ($config) {
            return new \Jenssegers\Mongodb\Connection($config);
        });
    }
}
