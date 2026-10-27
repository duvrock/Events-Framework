<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\AdminUser;

final class AuthController
{
    public static function login(string $method): void
    {
        if (isset($_SESSION['admin_user_id'])) {
            redirect('/admin/');
        }

        $error = '';
        $email = '';

        if ($method === 'POST') {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                http_response_code(403);
                $error = 'Sesiunea formularului a expirat. Reîncarcă pagina și încearcă din nou.';
            } else {
                $email = trim((string) ($_POST['email'] ?? ''));
                $password = (string) ($_POST['password'] ?? '');
                $user = (new AdminUser(Database::connection()))->authenticate($email, $password);

                if ($user !== null) {
                    session_regenerate_id(true);
                    $_SESSION['admin_user_id'] = $user['id'];
                    $_SESSION['admin_email'] = $user['email'];
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    redirect('/admin/');
                }

                $error = 'Datele de autentificare nu sunt valide sau contul este temporar blocat.';
            }
        }

        render_admin('login', [
            'error' => $error,
            'email' => $email,
            'csrfToken' => csrf_token(),
        ]);
    }

    public static function logout(string $method): void
    {
        if ($method !== 'POST' || !csrf_is_valid($_POST['csrf_token'] ?? null)) {
            http_response_code(403);
            render_admin('login', [
                'error' => 'Cererea nu a putut fi verificată. Autentifică-te din nou.',
                'email' => '',
                'csrfToken' => csrf_token(),
            ]);
            return;
        }

        $_SESSION = [];
        session_regenerate_id(true);
        redirect('/admin/login/');
    }
}
