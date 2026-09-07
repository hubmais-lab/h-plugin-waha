<?php
return [
    /*
    | Check documentation in https://waha.devlike.pro/docs/overview/quick-start/
    */

    /*
    |--------------------------------------------------------------------------
    | Host instaled
    |-------------------------------------------------------------------------- 
    | 
    | Use Ip address or domain name. Ex: http://127.0.0.1 or http://localhost
    |
    */
    'host' => env('WAHA_HOST', ''),

    /*
    |--------------------------------------------------------------------------
    | Port allowed
    |-------------------------------------------------------------------------- 
    | 
    | Check if port is allowed. Default port is 3000
    |
    */
    'port' => env('WAHA_PORT', 3000),
    
    /*
    |--------------------------------------------------------------------------
    | Api Key generated
    |-------------------------------------------------------------------------- 
    | 
    | Generate Api Key in dashboard Waha and paste here.
    |
    */
    'api_key' => env('WAHA_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Session Client Waha
    |-------------------------------------------------------------------------- 
    | 
    | Authorize new session client WhatsApp, before paste session id here.
    |
    */
    'session' => env('WAHA_SESSION', ''),
];