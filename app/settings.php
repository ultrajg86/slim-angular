<?php

return [
    'settings' => [
        // Only set this if you need access to route within middleware
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,
        'db'=>[
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'tracedb',
            'username' => 'root',
            'password' => '1111',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ]
    ]
];

?>