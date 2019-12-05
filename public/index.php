<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use App\HelloWorld;
use App\About;
use FastRoute\RouteCollector;
use League\Plates\Engine;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Narrowspark\HttpEmitter\SapiEmitter;
use Relay\Relay;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use function DI\create;
use function DI\get;
use function FastRoute\simpleDispatcher;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Set up dependencies
$containerBuilder = new ContainerBuilder();
(require_once dirname(__DIR__) . '/config/dependencies.php')($containerBuilder);

// Register routes
$routes = (require_once dirname(__DIR__) . '/config/routes.php')();

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($containerBuilder->build());

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

return (new SapiEmitter())->emit($response);
