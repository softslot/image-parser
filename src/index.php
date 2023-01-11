<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();

$app->get('/', function () {
    return 'Home Page!';
});

$app->get('/news', function () {
    return 'News Page!';
});

$app->get('/posts', function () {
    return 'Posts Page!';
});

$app->run();
