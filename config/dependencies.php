<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

return static function (ContainerBuilder $containerBuilder) {
    $containerBuilder->useAutowiring(true);
    $containerBuilder->useAnnotations(false);

    $containerBuilder->addDefinitions([
        ResponseInterface::class => function () {
            return new Response();
        },

        Engine::class => function () {
            return new Engine(dirname(__DIR__) . '/templates');
        },

        PDO::class => function () {
            $host = 'mysql';
            $db = 'linksapp';
            $user = 'root';
            $pass = 'rootpassword';
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            try {
                $pdo = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }

            return $pdo;
        },
    ]);
};
