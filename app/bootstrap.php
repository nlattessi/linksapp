<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$settings = (require_once dirname(__DIR__) . '/config/settings.php')();

// Create a simple "default" Doctrine ORM configuration for Annotations
$config = Setup::createAnnotationMetadataConfiguration(
    [__DIR__ . '/Entities'],
    true,
    __DIR__ . '/../tmp/doctrine',
    null,
    false
);

// database configuration parameters
$params = $settings['db'];

$conn = [
    'driver' => 'pdo_mysql',
    'dbname' => $params['db'],
    'user' => $params['user'],
    'password' => $params['password'],
    'host' => $params['host'],
    'charset' => $params['charset'],
];

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
$entityManager->getConfiguration()->addEntityNamespace('App', '\App\Entities');
