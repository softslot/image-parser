<?php

namespace App;

use function App\Template\render;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();

$app->get('/', function () {
    $links = [
        '/' => 'Главная',
        '/news' => 'Новости',
        '/posts' => 'Посты',
    ];

    $data = [
        'h1' => 'Главная страница сайта',
        'links' => $links,
        'content' => 'Контент главный страницы',
    ];

    return render('main', $data);
});

$app->get('/news', function ($params) {
    $links = [
        '/' => 'Главная',
        '/news' => 'Новости',
        '/posts' => 'Посты',
    ];

    $page = $params['page'] ?? 1;

    $data = [
        'h1' => 'Страница с новостями',
        'links' => $links,
        'content' => 'Контент страницы с новостями',
        'page' => $page,
    ];

    return render('news', $data);
});

$app->get('/posts', function ($params) {
    $links = [
        '/' => 'Главная',
        '/news' => 'Новости',
        '/posts' => 'Посты',
    ];

    $data = [
        'h1' => 'Страница с постами',
        'links' => $links,
        'content' => 'Контент страницы с постами',
    ];

    return render('posts', $data);
});

$app->run();
