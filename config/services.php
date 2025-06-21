<?php

use App\Database\Connection;
use App\Http\Kernel;
use App\Routing\RouteHandlerResolver;
use App\Routing\Router;
use League\Container\Container;
use League\Container\ReflectionContainer;

$container = new Container();

$container->delegate(new ReflectionContainer(true));

// parameters
$dsn = 'sqlite:db/tdd-with-pest.sqlite';
$container->add('dsn', new \League\Container\Argument\Literal\StringArgument($dsn));
$routes = include __DIR__.'/routes.php';

// services
$container->add(RouteHandlerResolver::class)
    ->addArguments([$container]);

$container->add(Router::class)
    ->addArguments([\App\Routing\RouteHandlerResolver::class]);

$container->extend(Router::class)
    ->addMethodCall('setRoutes', [$routes]);

$container->add(Kernel::class)
    ->addArguments([Router::class]);

$container->addShared(Connection::class)
    ->addArguments(['dsn']);

return $container;
