<?php

declare(strict_types=1);

return [
    "default" => env("BROADCAST_DRIVER", "null"),

    "connections" => [
        "pusher" => [
            'driver' => 'pusher',

            'key' => env('PUSHER_APP_KEY'),

            'secret' => env('PUSHER_APP_SECRET'),

            'app_id' => env('PUSHER_APP_ID'),

            'options' => [

                'cluster' => env('PUSHER_CLUSTER'),

                'useTLS' => true,

                'encrypted' => true,

                'log' => true,

            ],
            "client_options" => [],
        ],

        "ably" => [
            "driver" => "ably",
            "key" => env("ABLY_KEY"),
        ],

        "redis" => [
            "driver" => "redis",
            "connection" => "default",
        ],

        "log" => [
            "driver" => "log",
        ],

        "null" => [
            "driver" => "null",
        ],
    ],
];
