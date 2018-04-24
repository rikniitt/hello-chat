<?php

date_default_timezone_set('UTC');
define('PROJECT_DIR', realpath(__DIR__ . '/../'));
require PROJECT_DIR . '/vendor/autoload.php';

$app = new Silex\Application();

// Configure application
$app['debug'] = true;
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => PROJECT_DIR . '/views',
]);

// Define services
$app['home.controller'] = function() {
    return new HelloChat\Http\Controller\Home();
};

// Define routes
$app->get('/', 'home.controller:index');

// Dispatch
$app->run();
