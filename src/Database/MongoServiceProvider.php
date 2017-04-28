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

        // Register connection
        $cons = config()->get('database.connections', []);
        $cons['mongo'] = [
            'driver' => 'mongodb',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', 27017),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'options' => [
                'database' => 'admin'
            ]
        ];

        config()->set('database.connections', $cons);
    }
}
