<?php namespace NetForce\Framework;

use Illuminate\Support\AggregateServiceProvider;

class FrameworkServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        '\Jenssegers\Mongodb\MongodbServiceProvider',
        '\Jenssegers\Mongodb\MongodbQueueServiceProvider',
        '\NetForce\Framework\Http\HttpServiceProvider',
        '\NetForce\Framework\Database\MongoServiceProvider',
    ];
}
