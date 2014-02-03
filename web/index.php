<?php

require_once __DIR__.'/../vendor/autoload.php';

define('APP_PATH', realpath(dirname(__FILE__) . '/../app'));

require_once '../src/S2r/Gallery.php';

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

$app->get('/portrety-glamour', function () use ($app) {
    $dir = new \DirectoryIterator(dirname(__FILE__) . '/photos/portraits');
    $gallery = new S2r\Gallery();
    return $app['twig']->render(
        'galeria.twig',
        array(
            'page' => 'portrety-glamour',
            'gallery' => $gallery->getImages($dir),
        )
    );
});

$app->get('/o-mnie', function () use ($app) {
    return $app['twig']->render('about.twig', array('page' => 'o-mnie'));
});

$app->get('/kontakt', function () use ($app) {
    return $app['twig']->render('kontakt.twig', array('page' => 'kontakt'));
});

$app->get('/kobiece-krajobrazy', function () use ($app) {
    $dir = new \DirectoryIterator(dirname(__FILE__) . '/photos/female-landscapes');
    $gallery = new S2r\Gallery();
    return $app['twig']->render(
        'female-landscapes.twig',
        array(
            'page' => 'female-landscapes',
            'gallery' => $gallery->getImages($dir),
        )
    );
});

$app->get('/akty', function () use ($app) {
    $dir = new \DirectoryIterator(dirname(__FILE__) . '/photos/nudes');
    $gallery = new S2r\Gallery();
    return $app['twig']->render(
        'akty.twig',
        array(
            'page' => 'akty',
            'gallery' => $gallery->getImages($dir),
        )
    );
});

$app->run();
