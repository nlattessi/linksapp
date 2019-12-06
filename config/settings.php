<?php

declare(strict_types=1);

return static function () {
    $settings = [
        'db' => [
            'host' => 'mysql',
            'db' => 'linksapp',
            'user' => 'root',
            'password' => 'rootpassword',
            'charset' => 'utf8mb4',
        ],
    ];

    return $settings;
};