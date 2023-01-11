<?php

namespace App\Template;

function render(string $template, array $variables): string
{
    extract($variables);
    ob_start();
    include __DIR__ . "/resources/views/{$template}.phtml";

    return ob_get_clean();
}
