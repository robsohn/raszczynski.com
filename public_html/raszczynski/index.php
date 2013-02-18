<?php
define('APPS_PATH', realpath(dirname(__FILE__) . '/../../Apps/raszczynski.com'));
define('LIBS_PATH', realpath(dirname(__FILE__) . '/../../Libs'));

require_once LIBS_PATH . '/silex.phar';
require_once LIBS_PATH . '/S2r/Gallery.php';

$app = new Silex\Application();

use Symfony\Component\HttpFoundation\Response;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => APPS_PATH . '/views',
    'twig.class_path' => LIBS_PATH . '/vendor/twig/lib',
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

$app->get('/female-landscapes', function () use ($app) {
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

$app->get('/portraits', function () use ($app) {
    return $app['twig']->render('portraits.twig');
});

$app->error(function (\Exception $e, $code) use ($app) {
    error_log($e->getMessage());

    // logic to handle the error and return a Response
});

$app->run();
