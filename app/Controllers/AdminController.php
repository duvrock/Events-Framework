<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\ContactRequest;
use App\Models\Page;
use App\Models\SocialLinks;

final class AdminController
{
    public static function dashboard(): void
    {
        self::requireAdmin();
        $db = Database::connection();
        render_admin('dashboard', [
            'email' => (string) $_SESSION['admin_email'],
            'section' => 'overview',
            'pages' => (new Page($db))->all(),
            'requests' => (new ContactRequest($db))->recent(),
            'csrfToken' => csrf_token(),
        ]);
    }

    public static function editPage(string $slug, string $method): void
    {
        self::requireAdmin();
        $pages = new Page(Database::connection());
        $page = $pages->findBySlug($slug);

        if ($page === null) {
            http_response_code(404);
            render_admin('not-found', ['email' => (string) $_SESSION['admin_email']]);
            return;
        }

        $error = '';
        if ($method === 'POST') {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                http_response_code(403);
                $error = 'Sesiunea formularului a expirat. Reîncarcă pagina și încearcă din nou.';
            } else {
                $fields = [
                    'title' => trim((string) ($_POST['title'] ?? '')),
                    'meta_description' => trim((string) ($_POST['meta_description'] ?? '')),
                    'h1' => trim((string) ($_POST['h1'] ?? '')),
                    'intro' => trim((string) ($_POST['intro'] ?? '')),
                ];
                $error = self::validatePage($fields);

                if ($error === '') {
                    $pages->update((int) $page['id'], $fields);
                    redirect('/admin/');
                }

                $page = array_merge($page, $fields);
            }
        }

        render_admin('edit-page', [
            'email' => (string) $_SESSION['admin_email'],
            'section' => 'content',
            'page' => $page,
            'error' => $error,
            'csrfToken' => csrf_token(),
        ]);
    }

    public static function socialLinks(string $method): void
    {
        self::requireAdmin();
        $socialLinks = new SocialLinks(Database::connection());
        $links = $socialLinks->all();
        $error = '';
        $saved = false;

        if ($method === 'POST') {
            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                http_response_code(403);
                $error = 'Sesiunea formularului a expirat. Reîncarcă pagina și încearcă din nou.';
            } else {
                $submittedLinks = [];
                foreach (SocialLinks::PLATFORMS as $platform => $_label) {
                    $submittedLinks[$platform] = trim((string) ($_POST[$platform] ?? ''));
                }

                $error = self::validateSocialLinks($submittedLinks);
                if ($error === '') {
                    $socialLinks->save($submittedLinks);
                    $links = $submittedLinks;
                    $saved = true;
                } else {
                    $links = $submittedLinks;
                }
            }
        }

        render_admin('social-links', [
            'email' => (string) $_SESSION['admin_email'],
            'section' => 'social-links',
            'links' => $links,
            'platforms' => SocialLinks::PLATFORMS,
            'error' => $error,
            'saved' => $saved,
            'csrfToken' => csrf_token(),
        ]);
    }

    private static function requireAdmin(): void
    {
        if (!isset($_SESSION['admin_user_id'])) {
            redirect('/admin/login/');
        }
    }

    private static function validatePage(array $fields): string
    {
        $limits = [
            'title' => 160,
            'meta_description' => 320,
            'h1' => 160,
            'intro' => 700,
        ];

        foreach ($limits as $field => $limit) {
            $length = preg_match_all('/./us', $fields[$field]);
            if ($fields[$field] === '' || $length === false || $length > $limit) {
                return 'Completează toate câmpurile obligatorii și respectă lungimile indicate.';
            }
        }

        return '';
    }

    private static function validateSocialLinks(array $links): string
    {
        foreach ($links as $url) {
            if ($url === '') {
                continue;
            }

            if (strlen($url) > 2048
                || filter_var($url, FILTER_VALIDATE_URL) === false
                || parse_url($url, PHP_URL_SCHEME) !== 'https'
                || parse_url($url, PHP_URL_HOST) === false
                || parse_url($url, PHP_URL_HOST) === null
            ) {
                return 'Introdu linkuri valide care încep cu https:// sau lasă câmpul gol.';
            }
        }

        return '';
    }
}
