<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\Page;
use App\Models\SocialLinks;
use RuntimeException;

final class HomeController
{
    public static function index(array $site): void
    {
        $page = (new Page(Database::connection()))->findBySlug('home');
        if ($page === null) {
            throw new RuntimeException('The home page has not been seeded in the database.');
        }

        $canonical = trim((string) $site['brand']['url']);
        if ($canonical !== '') {
            $canonical = rtrim($canonical, '/') . '/';
        }

        $site['social'] = array_merge(
            $site['social'],
            (new SocialLinks(Database::connection()))->all()
        );

        render_page('home', [
            'title' => $page['title'],
            'description' => $page['meta_description'],
            'canonical' => $canonical,
            'page' => $page,
        ], $site);
    }
}
