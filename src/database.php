<?php
declare(strict_types=1);
namespace RestJS;

use DI\Container;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;
use Slim\Factory\AppFactory;
use Doctrine\ORM\EntityManager;

/** Database Established */
class Database {

    /** Database Connection Function */
    public static function connection() {

        /** Database Connection Configation */
        $config = [
            'host' => $_ENV['HOST_NAME'] ?? 'localhost',
            'dbname' => $_ENV['DATABASE_NAME'],
            'user' => $_ENV['USER_NAME'] ?? 'root',
            'password' => $_ENV['PASSWORD'] ?? '',
            'driver' => 'pdo_mysql',
        ];

        /** Database Connection */
        $connection = DriverManager::getConnection($config);

        /** Create Container using PHP-DI */
        $container = new Container();
        $container->set(EntityManager::class, fn() => EntityManager::create(
            $connection,
            ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../src/api/'])
        ));

        // Set Container to Create Application with on AppFactory
        AppFactory::setContainer($container);
    }
}