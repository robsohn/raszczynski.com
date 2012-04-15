<?php
define('APPS_PATH', realpath(dirname(__FILE__) . '/../../Apps/raszczynski.com'));
define('LIBS_PATH', realpath(dirname(__FILE__) . '/../../Libs'));

require_once LIBS_PATH . '/silex.phar';

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => APPS_PATH . '/views',
    'twig.class_path' => LIBS_PATH . '/vendor/twig/lib',
));

$app->before(function () use ($app) {
    $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig'));
});

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig', array('page' => 'fotografie'));
});

$app->get('/o-mnie', function () use ($app) {
    return $app['twig']->render('about.twig', array('page' => 'o-mnie'));
});

$app->get('/kontakt', function () use ($app) {
    return $app['twig']->render('kontakt.twig', array('page' => 'kontakt'));
});

$app->get('/female-landscapes', function () use ($app) {
    return $app['twig']->render('female-landscapes.twig');
});

$app->run();
