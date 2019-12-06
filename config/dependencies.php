<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

return static function (ContainerBuilder $containerBuilder, array $settings) {
    $containerBuilder->useAutowiring(true);
    $containerBuilder->useAnnotations(false);

    $containerBuilder->addDefinitions([
        'settings' => $settings,

        ResponseInterface::class => function () {
            return new Response();
        },

        Engine::class => function () {
            return new Engine(dirname(__DIR__) . '/templates');
        },

        PDO::class => static function (ContainerInterface $c) {
            $params = $c->get('settings')['db'];

            $host = $params['host'];
            $db = $params['db'];
            $charset = $params['charset'];
            $user = $params['user'];
            $password = $params['password'];

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                $pdo = new PDO($dsn, $user, $password, $options);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }

            return $pdo;
        },
    ]);
};
