<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

final class AdminUser
{
    private static ?string $dummyHash = null;

    public function __construct(private readonly PDO $db)
    {
    }

    public function authenticate(string $email, string $password): ?array
    {
        $statement = $this->db->prepare(
            'SELECT id, email, password_hash, failed_attempts, locked_until
             FROM admin_users WHERE email = :email LIMIT 1'
        );
        $statement->execute(['email' => strtolower($email)]);
        $user = $statement->fetch();

        if (!is_array($user)) {
            self::$dummyHash ??= password_hash('invalid-login-placeholder', PASSWORD_DEFAULT);
            password_verify($password, self::$dummyHash);
            return null;
        }

        if ($user['locked_until'] !== null && strtotime($user['locked_until']) > time()) {
            password_verify($password, $user['password_hash']);
            return null;
        }

        if (!password_verify($password, $user['password_hash'])) {
            $update = $this->db->prepare(
                'UPDATE admin_users
                 SET failed_attempts = failed_attempts + 1,
                     locked_until = CASE
                         WHEN failed_attempts + 1 >= 5 THEN DATE_ADD(UTC_TIMESTAMP(), INTERVAL 15 MINUTE)
                         ELSE locked_until
                     END
                 WHERE id = :id'
            );
            $update->execute(['id' => $user['id']]);
            return null;
        }

        $update = $this->db->prepare(
            'UPDATE admin_users
             SET failed_attempts = 0, locked_until = NULL, last_login_at = UTC_TIMESTAMP()
             WHERE id = :id'
        );
        $update->execute(['id' => $user['id']]);

        return ['id' => (int) $user['id'], 'email' => $user['email']];
    }
}
