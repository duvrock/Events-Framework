<section class="admin-page">
    <?php
    $error = $data['error'] ?? '';
    $saved = $data['saved'] ?? false;
    $csrfToken = $data['csrfToken'] ?? csrf_token();
    $links = $data['links'] ?? [];
    $platforms = $data['platforms'] ?? \App\Models\SocialLinks::PLATFORMS;
    ?>
    <div class="admin-header">
        <div>
            <p class="admin-kicker">Setări site</p>
            <h1>Linkuri media</h1>
            <p class="admin-description">Adaugă adresele profilurilor tale. Doar linkurile completate vor apărea pe site.</p>
        </div>
    </div>

    <?php if ($error !== ''): ?>
        <p class="form-message form-error" role="alert"><?= e($error) ?></p>
    <?php elseif ($saved): ?>
        <p class="form-message form-success" role="status">Linkurile au fost salvate.</p>
    <?php endif; ?>

    <form class="admin-panel admin-form social-links-form" method="post" action="/admin/settings/social-links/">
        <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">
        <?php foreach ($platforms as $platform => $label): ?>
            <label for="social-<?= e($platform) ?>"><?= e($label) ?></label>
            <input
                id="social-<?= e($platform) ?>"
                name="<?= e($platform) ?>"
                type="url"
                inputmode="url"
                maxlength="2048"
                placeholder="https://"
                value="<?= e($links[$platform]) ?>"
                autocomplete="url"
            >
        <?php endforeach; ?>
        <p class="admin-description">Folosește adresa publică a profilului, cu https://. Câmpurile necompletate nu vor afișa iconițe.</p>
        <button class="button" type="submit">Salvează linkurile</button>
    </form>
</section>
