<?php

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("CLI only.\n");
}

require dirname(__DIR__) . '/app/bootstrap.php';

try {
    $pdo = App\Core\Database::connection();
    $schema = file_get_contents(dirname(__DIR__) . '/database/schema.sql');
    if ($schema === false) {
        throw new RuntimeException('Could not read the database schema file.');
    }

    foreach (explode(';', $schema) as $statement) {
        if (trim($statement) !== '') {
            $pdo->exec($statement);
        }
    }

    fwrite(STDOUT, "Database schema installed and starter pages inserted.\n");
} catch (Throwable $error) {
    fwrite(STDERR, 'Migration failed: ' . $error->getMessage() . "\n");
    exit(1);
}
