<?php

declare(strict_types=1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function render_page(string $template, array $site): void
{
    $templatePath = dirname(__DIR__) . '/templates/pages/' . $template . '.php';

    if (!is_file($templatePath)) {
        http_response_code(404);
        $templatePath = dirname(__DIR__) . '/templates/pages/404.php';
    }

    $pageTitle = $site['brand']['name'];
    $pageDescription = $site['brand']['description'];
    $canonical = '';
    $structuredData = null;

    ob_start();
    require $templatePath;
    $pageContent = ob_get_clean();

    require dirname(__DIR__) . '/templates/layouts/base.php';
}
