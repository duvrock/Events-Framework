<footer class="site-footer">
    <div class="container footer-main">
        <div class="footer-brand">
            <a class="brand" href="/">
                <?php if (!empty($site['brand']['logo'])): ?>
                    <img class="brand-logo" src="<?= e($site['brand']['logo']) ?>" alt="">
                <?php else: ?>
                    <span class="brand-mark" aria-hidden="true">S</span>
                <?php endif; ?>
                <span class="brand-name"><?= e($site['brand']['name']) ?></span>
            </a>
            <p>Entertainment pentru evenimente în <?= e($site['location']['service_area']) ?>.</p>
        </div>

        <div class="footer-links">
            <h2>Explorează</h2>
            <a href="/#servicii">Servicii</a>
            <a href="/contact/">Contact</a>
        </div>

        <div class="footer-links">
            <h2>Contact</h2>
            <?php if ($site['contact']['phone'] !== ''): ?>
                <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $site['contact']['phone'])) ?>"><?= e($site['contact']['phone']) ?></a>
            <?php endif; ?>
            <?php if (($site['contact']['phone_secondary'] ?? '') !== ''): ?>
                <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $site['contact']['phone_secondary'])) ?>"><?= e($site['contact']['phone_secondary']) ?></a>
            <?php endif; ?>
            <?php if ($site['contact']['email'] !== ''): ?>
                <a href="mailto:<?= e($site['contact']['email']) ?>"><?= e($site['contact']['email']) ?></a>
            <?php endif; ?>
            <?php if ($site['contact']['phone'] === '' && $site['contact']['email'] === ''): ?>
                <p>Datele de contact vor fi adăugate înainte de publicare.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="container footer-bottom">
        <p>&copy; <?= date('Y') ?> <?= e($site['brand']['name']) ?></p>
        <p><?= e($site['location']['service_area']) ?></p>
    </div>
</footer>
