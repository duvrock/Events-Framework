<?php

declare(strict_types=1);

$title = $data['title'] ?? $site['brand']['name'];
$description = $data['description'] ?? $site['brand']['description'];
$canonical = $data['canonical'] ?? '';
$colors = $site['colors'];
?>
<!doctype html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= e($description) ?>">
    <meta name="theme-color" content="<?= e($colors['background']) ?>">
    <title><?= e($title) ?> | <?= e($site['brand']['name']) ?></title>
    <?php if (isset($data['structuredData'])): ?>
        <script type="application/ld+json"><?= json_encode($data['structuredData'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) ?></script>
    <?php endif; ?>
    <?php if ($canonical !== ''): ?>
        <link rel="canonical" href="<?= e($canonical) ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/assets/css/public-theme.css">
    <script src="/assets/js/main.js" defer></script>
</head>
<body style="<?= e('--color-bg: ' . $colors['background'] . '; --color-surface: ' . $colors['surface'] . '; --color-accent: ' . $colors['accent'] . '; --color-accent-light: ' . $colors['accent_light'] . '; --color-text: ' . $colors['text'] . '; --color-muted: ' . $colors['muted'] . ';') ?>">
    <a class="skip-link" href="#main">Sari la conținut</a>
    <?php require dirname(__DIR__) . '/components/header.php'; ?>
    <main id="main">
        <?php require $templatePath; ?>
    </main>
    <?php require dirname(__DIR__) . '/components/footer.php'; ?>
</body>
</html>
