<?php

if (! function_exists('db')) {

    /**
     * Carregar DB
     * @param null|string$connection
     * @return \Illuminate\Database\DatabaseManager|\Illuminate\Database\Connection
     */
    function db($connection = null)
    {
        $db = app('db');

        if (is_null($connection)) {
            return $db;
        }

        return $db->connection($connection);
    }
}


if (! function_exists('api')) {

    /**
     * Carregar API.
     * @param null|string $return
     * @return \Illuminate\Http\JsonResponse|\NetForce\Framework\Http\Api
     */
    function api($return = null)
    {
        $api = app('api-helper');

        if (is_null($return)) {
            return $api;
        }

        return $api->json($return);
    }
}

if (! function_exists('auth')) {

    /**
     * Auth.
     * @param null $guard
     * @return \Illuminate\Auth\AuthManager|\Illuminate\Contracts\Auth\Guard
     */
    function auth($guard = null)
    {
        $auth = app('auth');

        if (is_null($guard)) {
            return $auth;
        }

        // Se for informado o guard false ou '', é o guard padrao
        $guard = (($guard === false) || ($guard == '')) ? null : $guard;

        return $auth->guard($guard);
    }
}

if (! function_exists('schema')) {

    /**
     * @param null $connection
     * @return \Illuminate\Database\Schema\Builder
     */
    function schema($connection = null)
    {
        return app('db')->connection($connection)->getSchemaBuilder();
    }
}