<?php namespace NetForce\Framework\Http;

class Api
{
    /**
     * Enviar reposta via json.
     *
     * @param $return
     * @return \Illuminate\Http\JsonResponse
     */
    public function json($return)
    {
        $headers = [];
        $headers['Content-Type'] = 'application/json; charset=utf-8';
        $headers['Access-Control-Allow-Origin'] = '*';

        return response()->json($return, 200, $headers, JSON_PRETTY_PRINT);
    }
}