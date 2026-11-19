<?php

declare(strict_types=1);

namespace App\Controllers;

final class HomeController
{
    public static function contact(array $site): void
    {
        render_page('contact', $site);
    }

    public static function breakdance(array $site): void
    {
        render_page('breakdance', $site);
    }

    public static function index(array $site): void
    {
        render_page('home', $site);
    }
}
