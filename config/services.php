<?php

use App\Database\Connection;
use App\Http\Kernel;
use App\Http\Middleware\JwtAuthenticate;
use App\Http\Middleware\RequestHandler;
use App\Http\Middleware\RequestHandlerInterface;
use App\Routing\RouteHandlerResolver;
use App\Routing\Router;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use League\Container\ReflectionContainer;
use Symfony\Component\Dotenv\Dotenv;

$container = new Container();

$container->delegate(new ReflectionContainer(true));
$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__).'/.env');

// parameters
$dsn = $_ENV['DSN'];
$container->add('dsn', new StringArgument($dsn));
$routes = include __DIR__.'/routes.php';
$migrationsFolder = dirname(__DIR__).'/migrations';
$container->add(
    'migrations_folder',
    new StringArgument($migrationsFolder)
);
$jwtSecretKey = $_ENV['JWT_SECRET_KEY'];
$container->add('jwtSecretKey', new StringArgument($jwtSecretKey));

// services
$container->add(RouteHandlerResolver::class)
    ->addArguments([$container]);

$container->add(Router::class)
    ->addArguments([RouteHandlerResolver::class]);

$container->extend(Router::class)
    ->addMethodCall('setRoutes', [$routes]);

$container->add(
    RequestHandlerInterface::class,
    RequestHandler::class
)->addArgument($container);

$container->add(Kernel::class)
    ->addArguments([RequestHandlerInterface::class]);

$container->addShared(Connection::class)
    ->addArguments(['dsn']);

$container->add(JwtAuthenticate::class)
    ->addArgument('jwtSecretKey');

return $container;
