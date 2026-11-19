<?php

declare(strict_types=1);

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$requestPath = is_string($requestPath) ? rawurldecode($requestPath) : '/';
$publicRoot = realpath(__DIR__);
$requestedFile = realpath(__DIR__ . $requestPath);
$staticExtensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'webp', 'svg', 'mp4', 'woff', 'woff2'];

if (PHP_SAPI === 'cli-server'
    && $publicRoot !== false
    && $requestedFile !== false
    && str_starts_with($requestedFile, $publicRoot . DIRECTORY_SEPARATOR)
    && is_file($requestedFile)
    && in_array(strtolower(pathinfo($requestedFile, PATHINFO_EXTENSION)), $staticExtensions, true)
) {
    return false;
}

require dirname(__DIR__) . '/app/bootstrap.php';

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$path = is_string($path) ? $path : '/';
$path = $path !== '/' ? rtrim($path, '/') . '/' : '/';

if ($path === '/') {
    App\Controllers\HomeController::index($site);
    return;
}

if ($path === '/contact/') {
    App\Controllers\HomeController::contact($site);
    return;
}

if ($path === '/show-uri-dans-nunti-evenimente-craiova/') {
    App\Controllers\HomeController::breakdance($site);
    return;
}

http_response_code(404);
render_page('404', $site);
