<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

return static function (ContainerBuilder $containerBuilder, array $settings): void {

    global $entityManager;

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

        EntityManager::class => function (ContainerInterface $c) use ($entityManager) {
            return $entityManager;
        },
    ]);
};
