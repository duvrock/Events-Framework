<?php

declare(strict_types=1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function render_page(string $template, array $data, array $site): void
{
    $templatePath = dirname(__DIR__) . '/templates/pages/' . $template . '.php';

    if (!is_file($templatePath)) {
        http_response_code(404);
        $templatePath = dirname(__DIR__) . '/templates/pages/404.php';
        $data = [
            'title' => 'Pagina nu a fost găsită',
            'description' => 'Pagina solicitată nu a fost găsită.',
        ];
    }

    require dirname(__DIR__) . '/templates/layouts/base.php';
}

function render_admin(string $template, array $data = []): void
{
    $templatePath = dirname(__DIR__) . '/templates/admin/' . $template . '.php';

    if (!is_file($templatePath)) {
        throw new RuntimeException('Admin template not found: ' . $template);
    }

    require dirname(__DIR__) . '/templates/layouts/admin.php';
}

function csrf_token(): string
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrf_is_valid(?string $token): bool
{
    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

function redirect(string $location): never
{
    header('Location: ' . $location, true, 303);
    exit;
}
