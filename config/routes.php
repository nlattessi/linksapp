<?php

declare(strict_types=1);

use App\Controllers\Categories\AddCategory;
use App\Controllers\Categories\DeleteCategory;
use App\Controllers\Categories\ShowCategory;
use App\Controllers\Categories\ShowFormAddCategory;
use App\Controllers\Home;
use App\Controllers\Links\AddLink;
use App\Controllers\Links\DeleteLink;
use App\Controllers\Links\ShowFormAddLink;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

return static function (): Dispatcher {
    $routes = simpleDispatcher(function (RouteCollector $r) {
        $r->get('/', Home::class);

        $r->get('/category/{name}', ShowCategory::class);

        $r->get('/agregar-categoria', ShowFormAddCategory::class);
        $r->post('/agregar-categoria', AddCategory::class);

        $r->get('/category/{name}/add-link', ShowFormAddLink::class);
        $r->post('/category/{name}/add-link', AddLink::class);

        $r->post('/categories/{id:\d+}/delete', DeleteCategory::class);
        $r->post('/links/{id:\d+}/delete', DeleteLink::class);
    });

    return $routes;
};
