<?php

declare(strict_types=1);

use App\AgregarCategoria;
use App\AgregarLink;
use App\Categoria;
use App\Home;
use App\ShowFormAgregarCategoria;
use App\ShowFormAgregarLink;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

return static function () {
    $routes = simpleDispatcher(function (RouteCollector $r) {
        $r->get('/', Home::class);

        $r->get('/agregar-categoria', ShowFormAgregarCategoria::class);
        $r->post('/agregar-categoria', AgregarCategoria::class);

        $r->get('/categorias/{categoria}', Categoria::class);

        $r->get('/agregar-link', ShowFormAgregarLink::class);
        $r->post('/agregar-link', AgregarLink::class);
    });

    return $routes;
};
