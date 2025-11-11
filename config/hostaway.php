<?php

return [

     /*
    |--------------------------------------------------------------------------
    | Hostaway API Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for the Hostaway API.
    | These values are pulled directly from your .env file.
    |
    */

     'base_url' => env('HOSTAWAY_BASE_URL', 'https://api.hostaway.com/v1'),

     'client_id' => env('HOSTAWAY_CLIENT_ID'),

     'client_secret' => env('HOSTAWAY_CLIENT_SECRET'),

     'grant_type' => env('HOSTAWAY_GRANT_TYPE', 'client_credentials'),
     // Test Fork
];
