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

    return render('news/index', $data);
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

    return render('posts/index', $data);
});

$app->get('/posts/(?P<id>\d+)', function ($params, $variables) {
    $posts = [
        1 => ['h1' => 'Пост номер 1', 'description' => 'Описание поста номер 1'],
        2 => ['h1' => 'Пост номер 2', 'description' => 'Описание поста номер 2'],
        3 => ['h1' => 'Пост номер 3', 'description' => 'Описание поста номер 3'],
        4 => ['h1' => 'Пост номер 4', 'description' => 'Описание поста номер 4'],
        5 => ['h1' => 'Пост номер 5', 'description' => 'Описание поста номер 5'],
    ];

    $id = $variables['id'];

    if (!array_key_exists($id, $posts)) {
        http_response_code(404);
        return;
    }

    $data = [
        ...$posts[$id],
    ];

    return render('posts/show', $data);
});

$app->run();
