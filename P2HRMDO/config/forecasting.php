<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Node.js Binary
    |--------------------------------------------------------------------------
    |
    | Path to the Node.js executable used to run scripts/arima_forecast.js.
    | Defaults to resolving "node" from the web server's PATH. Set NODE_BINARY
    | to an absolute path when the server's PATH does not include Node (common
    | with XAMPP, shared hosting, and php-fpm).
    |
    */

    'node_binary' => env('NODE_BINARY', 'node'),

    /*
    |--------------------------------------------------------------------------
    | Forecast Timeout
    |--------------------------------------------------------------------------
    |
    | Seconds to wait for the forecast script before abandoning the run. The
    | script is called synchronously while a user waits on the page, so this is
    | deliberately shorter than the framework's 60 second default.
    |
    */

    'timeout' => (int) env('FORECAST_TIMEOUT', 10),

];
