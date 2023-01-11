<?php

require_once __DIR__ . '/../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/') {
    // Главная страница
    echo 'Home Page!';
} elseif ($uri === '/news') {
    // Страница с новостями
    echo 'News Page!';
} elseif ($uri === '/posts') {
    // Страница с постами
    echo 'Posts Page!';
} else {
    // Несуществующая страница
    echo 'Not Found Page!';
}
