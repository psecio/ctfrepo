<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/view.php';

$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();

$app = new Slim\App();
$container = $app->getContainer();

$container['view'] = function() use ($container) {
    $view = new TemplateView(__DIR__.'/../templates');
    $view['container'] = $container;
    $env = $view->getEnvironment();

    // Set up the "env" helper function
    $function = new Twig_SimpleFunction('serialize', function($data) {
        return serialize($data);
    });
    $env->addFunction($function);

    return $view;
};

$container['db'] = function() {
    $dsn = 'mysql:dbname='.$_ENV['MYSQL_DATABASE'].';host='.$_ENV['MYSQL_HOST'];
    return new \PDO($dsn, $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);
};

$container['session'] = function() {
    $session_factory = new \Aura\Session\SessionFactory;
    $session = $session_factory->newInstance($_COOKIE);
    return $session->getSegment('default');
};