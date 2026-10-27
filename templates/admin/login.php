<section class="admin-card admin-login">
    <a class="brand" href="/">
        <span class="brand-mark" aria-hidden="true">S</span>
        <span class="brand-name">ShowTime Craiova</span>
    </a>
    <p class="eyebrow"><span class="eyebrow-line"></span> Administrare</p>
    <h1>Autentificare</h1>
    <p class="admin-description">Conectează-te pentru a administra conținutul site-ului.</p>
    <?php if ($data['error'] !== ''): ?>
        <p class="form-message form-error" role="alert"><?= e($data['error']) ?></p>
    <?php endif; ?>
    <form method="post" action="/admin/login/" class="admin-form">
        <input type="hidden" name="csrf_token" value="<?= e($data['csrfToken']) ?>">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" autocomplete="username" required maxlength="190" value="<?= e($data['email']) ?>">
        <label for="password">Parolă</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required>
        <button class="button" type="submit">Intră în cont</button>
    </form>
</section>
