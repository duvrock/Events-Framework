<?php

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("CLI only.\n");
}

require dirname(__DIR__) . '/app/bootstrap.php';

$email = filter_var(getenv('ADMIN_EMAIL') ?: '', FILTER_VALIDATE_EMAIL);
$password = getenv('ADMIN_PASSWORD') ?: '';

if ($email === false || strlen($password) < 16) {
    fwrite(STDERR, "Set ADMIN_EMAIL and an ADMIN_PASSWORD of at least 16 characters in the server environment.\n");
    exit(1);
}

try {
    $statement = App\Core\Database::connection()->prepare(
        'INSERT INTO admin_users (email, password_hash) VALUES (:email, :password_hash)'
    );
    $statement->execute([
        'email' => strtolower($email),
        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    fwrite(STDOUT, "Administrator account created.\n");
} catch (Throwable $error) {
    fwrite(STDERR, 'Could not create administrator: ' . $error->getMessage() . "\n");
    exit(1);
}
