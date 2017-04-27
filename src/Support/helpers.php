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