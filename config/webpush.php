<?php

return [

    /*
    |--------------------------------------------------------------------------
    | VAPID Keys
    |--------------------------------------------------------------------------
    |
    | These keys are used to authenticate your web push notifications.
    | You can generate them using Minishlink\WebPush\VAPID::createVapidKeys().
    |
    */

    'vapid' => [
        'subject' => env('VAPID_SUBJECT', 'mailto:your-email@example.com'),
        'public_key' => env('VAPID_PUBLIC_KEY'),
        'private_key' => env('VAPID_PRIVATE_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | Additional options for the web push notification service.
    |
    */

    'options' => [
        // Example: 'TTL' => 300,
    ],

];
