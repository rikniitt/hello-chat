#!/usr/bin/env php
<?php

date_default_timezone_set('UTC');
define('PROJECT_DIR', realpath(__DIR__));
require PROJECT_DIR . '/vendor/autoload.php';

$app = new Ratchet\App('localhost', 8080);
$app->route('/websocket/chat', new HelloChat\WebSocket\Message\Chat());
$app->route('/websocket/echo', new Ratchet\Server\EchoServer, ['*']);
$app->run();
