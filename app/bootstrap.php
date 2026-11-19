<?php

declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

date_default_timezone_set('UTC');

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = __DIR__ . '/' . str_replace('\\', '/', $relativeClass) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

$site = require dirname(__DIR__) . '/config/site.php';
