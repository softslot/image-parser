<?php

namespace App\Template;

function render(string $template, array $variables): string
{
    extract($variables);
    ob_start();

    $templatepath = buildFullPathToTemplate($template);
    include $templatepath;

    $html = ob_get_clean();

    return $html;
}

function buildFullPathToTemplate($template)
{
    $parts = [
        getcwd(),
        'resources',
        'views',
        "{$template}.phtml"
    ];

    $path = implode(DIRECTORY_SEPARATOR, $parts);

    return $path;
}
