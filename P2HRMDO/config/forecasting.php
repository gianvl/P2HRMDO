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

];
