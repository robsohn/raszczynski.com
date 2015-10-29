<?php

require_once __DIR__.'/../vendor/autoload.php';

define('APP_PATH', realpath(dirname(__FILE__) . '/../app'));

$app = new Silex\Application();

use Symfony\Component\HttpFoundation\Response;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => APP_PATH . '/Resources/views',
));

$app->before(function () use ($app) {
    $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig'));
});

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig', array('page' => 'index'));
});

$app->run();