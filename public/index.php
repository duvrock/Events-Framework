<?php

declare(strict_types=1);

require dirname(__DIR__) . '/app/bootstrap.php';

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$path = is_string($path) ? $path : '/';
$path = $path !== '/' ? rtrim($path, '/') . '/' : '/';
$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

try {
    if (preg_match('#\A/admin/login/\z#', $path) === 1) {
        App\Controllers\AuthController::login($method);
        return;
    }

    if (preg_match('#\A/admin/logout/\z#', $path) === 1) {
        App\Controllers\AuthController::logout($method);
        return;
    }

    if ($path === '/') {
        App\Controllers\HomeController::index($site);
        return;
    }

    if ($path === '/contact/') {
        App\Controllers\HomeController::contact($site, $method);
        return;
    }

    if ($path === '/show-uri-dans-nunti-evenimente-craiova/') {
        App\Controllers\HomeController::breakdance($site);
        return;
    }

    if ($path === '/admin/') {
        App\Controllers\AdminController::dashboard();
        return;
    }

    if ($path === '/admin/settings/social-links/') {
        App\Controllers\AdminController::socialLinks($method);
        return;
    }

    if (preg_match('#\A/admin/pages/([a-z0-9-]+)/\z#', $path, $matches) === 1) {
        App\Controllers\AdminController::editPage($matches[1], $method);
        return;
    }

    http_response_code(404);
    render_page('404', [
        'title' => 'Pagina nu a fost găsită',
        'description' => 'Pagina solicitată nu a fost găsită.',
        'canonical' => '',
    ], $site);
} catch (PDOException | RuntimeException $error) {
    error_log($error::class . ': ' . $error->getMessage());
    http_response_code(503);
    render_page('service-unavailable', [
        'title' => 'Serviciul este temporar indisponibil',
        'description' => 'Configurarea serviciului este în curs.',
        'canonical' => '',
    ], $site);
}
