<?php

return [
    'api_key' => env('FOOTBALL_API_KEY'),
    'api_origin' => env('FOOTBALL_API_ORIGIN'),
    'api_timezone' => env('FOOTBALL_API_TIMEZONE') ?: env('APP_TIMEZONE'),
];