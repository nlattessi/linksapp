<?php

declare(strict_types=1);

use App\Controllers\Categories\AddCategory;
use App\Controllers\Categories\ShowFormAddCategory;
use App\Controllers\Home;
use App\Controllers\Links\AddLink;
use App\Controllers\Links\ShowFormAddLink;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

return static function () {
    $routes = simpleDispatcher(function (RouteCollector $r) {
        $r->get('/', Home::class);

        $r->get('/agregar-categoria', ShowFormAddCategory::class);
        $r->post('/agregar-categoria', AddCategory::class);

        $r->get('/agregar-link', ShowFormAddLink::class);
        $r->post('/agregar-link', AddLink::class);
    });

    return $routes;
};
