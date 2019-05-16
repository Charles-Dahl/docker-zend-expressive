<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Zend\Expressive\Application;
use Zend\Expressive\Handler\NotFoundHandler;
use Zend\Expressive\MiddlewareFactory;
use Zend\Expressive\Router\Middleware\DispatchMiddleware;

$container = require 'config/container.php';

$app = $container->get(\Zend\Expressive\Application::class);
$factory = $container->get(\Zend\Expressive\MiddlewareFactory::class);

$app->pipe(\ResourceBundle\Middleware\ResourceRegistryMiddleware::class);
$app->pipe(\ResourceBundle\Middleware\EventsMiddleware::class);
$app->pipe(\ResourceBundle\Middleware\DoctrineTargetEntitiesResolverMiddleware::class);

// fluff a dispatch
// to end the middleware process
$app->pipe(DispatchMiddleware::class);
$app->pipe(NotFoundHandler::class); // change to return empty response

$app->run();
$em = $container->get("doctrine.entity_manager.orm_default");

return ConsoleRunner::createHelperSet(
	$em
);