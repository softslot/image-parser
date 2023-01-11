<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = [
    ['/', function () {
        return 'Home Page!';
    }],
    ['/news', function () {
        return 'News Page!';
    }],
    ['/posts', function () {
        return 'Posts Page!';
    }],
];

$app = new Application($routes);
$app->run();
