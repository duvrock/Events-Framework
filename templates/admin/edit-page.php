<section class="admin-page">
    <a class="admin-back-link" href="/admin/">← Înapoi la prezentarea generală</a>
    <p class="eyebrow"><span class="eyebrow-line"></span> Editare pagină</p>
    <h1><?= e($data['page']['title']) ?></h1>
    <p class="admin-description">URL permanent: <code><?= $data['page']['slug'] === 'home' ? '/' : '/' . e($data['page']['slug']) . '/' ?></code></p>

    <?php if ($data['error'] !== ''): ?>
        <p class="form-message form-error" role="alert"><?= e($data['error']) ?></p>
    <?php endif; ?>

    <form method="post" class="admin-panel admin-form">
        <input type="hidden" name="csrf_token" value="<?= e($data['csrfToken']) ?>">
        <label for="title">Titlu SEO</label>
        <input id="title" name="title" maxlength="160" required value="<?= e($data['page']['title']) ?>">
        <label for="meta_description">Meta description</label>
        <textarea id="meta_description" name="meta_description" maxlength="320" rows="3" required><?= e($data['page']['meta_description']) ?></textarea>
        <label for="h1">H1</label>
        <input id="h1" name="h1" maxlength="160" required value="<?= e($data['page']['h1']) ?>">
        <label for="intro">Introducere</label>
        <textarea id="intro" name="intro" maxlength="700" rows="4" required><?= e($data['page']['intro']) ?></textarea>
        <div class="admin-form-actions">
            <button class="button" type="submit">Salvează modificările</button>
            <a class="admin-link-button" href="/admin/">Anulează</a>
        </div>
    </form>
</section>
