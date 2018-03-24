<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/view.php';

$app = new Slim\App();
$container = $app->getContainer();

$container['view'] = function() use ($container) {
    $view = new TemplateView(__DIR__.'/../templates');
    $view['container'] = $container;

    return $view;
};