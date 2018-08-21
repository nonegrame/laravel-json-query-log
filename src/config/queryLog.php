<?php
return [

    /*
    |--------------------------------------------------------------------------
    | enable or disable, default disable
    |--------------------------------------------------------------------------
    |
    |
    */
    'DEBUG_QUERY_ENABLED' => env("DEBUG_QUERY_ENABLED", false),

    /*
    |--------------------------------------------------------------------------
    | enable middles
    |--------------------------------------------------------------------------
    |  query log will append this middleware when Response instanceof JsonResponse
    |  allow string or array
    |  example
    | 'MiddleAppend' => 'api'
    | or
    | 'MiddleAppend' => ['api', 'backApi']
    */
    'MIDDLE_APPEND' => ['api']
];