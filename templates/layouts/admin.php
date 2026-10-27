<?php

declare(strict_types=1);

$title = $data['title'] ?? 'Administrare';
?>
<!doctype html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title><?= e($title) ?> | Administrare ShowTime Craiova</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body class="admin-body">
    <?php if (isset($data['email'])): ?>
        <?php $section = $data['section'] ?? 'overview'; ?>
        <div class="admin-app">
            <aside class="admin-sidebar" aria-label="Navigare administrare">
                <a class="brand admin-brand" href="/admin/">
                    <span class="brand-mark" aria-hidden="true">S</span>
                    <span class="brand-name">ShowTime <span>Craiova</span></span>
                </a>
                <p class="admin-nav-label">MENIU PRINCIPAL</p>
                <nav class="admin-nav">
                    <a class="<?= $section === 'overview' ? 'is-active' : '' ?>" href="/admin/" <?= $section === 'overview' ? 'aria-current="page"' : '' ?>>
                        <span class="admin-nav-icon" aria-hidden="true">⌂</span>
                        <span>Prezentare generală</span>
                    </a>
                    <a class="<?= $section === 'content' ? 'is-active' : '' ?>" href="/admin/#pages" <?= $section === 'content' ? 'aria-current="page"' : '' ?>>
                        <span class="admin-nav-icon" aria-hidden="true">▤</span>
                        <span>Conținut site</span>
                    </a>
                    <a href="/admin/#requests">
                        <span class="admin-nav-icon" aria-hidden="true">✉</span>
                        <span>Solicitări</span>
                        <?php if (isset($data['requests']) && $data['requests'] !== []): ?>
                            <span class="admin-nav-count"><?= count($data['requests']) ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="admin-nav-group">
                        <span class="admin-nav-group-label">Setări</span>
                        <a class="admin-nav-subitem <?= $section === 'social-links' ? 'is-active' : '' ?>" href="/admin/settings/social-links/" <?= $section === 'social-links' ? 'aria-current="page"' : '' ?>>
                            <span class="admin-nav-icon" aria-hidden="true">◎</span>
                            <span>Linkuri media</span>
                        </a>
                    </div>
                </nav>
                <div class="admin-sidebar-bottom">
                    <a href="/" target="_blank" rel="noopener">
                        <span class="admin-nav-icon" aria-hidden="true">↗</span>
                        <span>Vezi site-ul</span>
                    </a>
                    <p>Panou de administrare</p>
                </div>
            </aside>
            <div class="admin-main">
                <header class="admin-topbar">
                    <div class="admin-topbar-title">
                        <span>Administrare</span>
                        <strong><?= match ($section) {
                            'content' => 'Editare conținut',
                            'social-links' => 'Linkuri media',
                            default => 'Prezentare generală',
                        } ?></strong>
                    </div>
                    <div class="admin-user">
                        <span class="admin-user-avatar" aria-hidden="true"><?= e(strtoupper(substr($data['email'], 0, 1))) ?></span>
                        <span class="admin-user-email"><?= e($data['email']) ?></span>
                        <form method="post" action="/admin/logout/">
                            <input type="hidden" name="csrf_token" value="<?= e($data['csrfToken'] ?? csrf_token()) ?>">
                            <button type="submit" class="admin-link-button">Deconectare</button>
                        </form>
                    </div>
                </header>
                <main class="admin-content">
                    <?php require $templatePath; ?>
                </main>
            </div>
        </div>
    <?php else: ?>
        <main class="admin-shell">
            <?php require $templatePath; ?>
        </main>
    <?php endif; ?>
</body>
</html>
