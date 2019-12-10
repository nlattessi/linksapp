<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Narrowspark\HttpEmitter\SapiEmitter;
use Relay\Relay;
use Zend\Diactoros\ServerRequestFactory;

require_once dirname(__DIR__) . '/app/bootstrap.php';

// Set up dependencies
$containerBuilder = new ContainerBuilder();
(require_once dirname(__DIR__) . '/config/dependencies.php')($containerBuilder, $settings);

// Register routes
$routes = (require_once dirname(__DIR__) . '/config/routes.php')();

// Register middlewares
$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($containerBuilder->build());

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

(new SapiEmitter())->emit($response);
