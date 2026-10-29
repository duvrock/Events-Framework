<footer class="site-footer">
    <div class="container footer-main">
        <nav class="footer-links" aria-label="Servicii evenimente">
            <h2>Servicii evenimente</h2>
            <a href="/show-uri-dans-nunti-evenimente-craiova/">Show-uri de breakdance</a>
            <a href="/#servicii">DJ pentru evenimente</a>
            <a href="/#servicii">MC pentru evenimente</a>
            <a href="/#servicii">Petreceri pentru copii</a>
            <a class="footer-view-all" href="/#servicii">Vezi toate serviciile</a>
        </nav>

        <nav class="footer-links" aria-label="Opțiuni de entertainment">
            <h2>Entertainment</h2>
            <a href="/show-uri-dans-nunti-evenimente-craiova/">Show-uri de dans</a>
            <a href="/#servicii">Momente interactive</a>
            <a href="/#servicii">Evenimente private</a>
            <a href="/#servicii">Evenimente corporate</a>
        </nav>

        <nav class="footer-links" aria-label="Informații generale">
            <h2>Informații</h2>
            <a href="/#despre">Despre ShowTime</a>
            <a href="/#intrebari">Întrebări frecvente</a>
            <a href="/#servicii">Servicii</a>
            <a href="/contact/">Cere o ofertă</a>
        </nav>

        <div class="footer-brand">
            <a class="brand" href="/">
                <?php if (!empty($site['brand']['logo'])): ?>
                    <img class="brand-logo" src="<?= e($site['brand']['logo']) ?>" alt="">
                <?php else: ?>
                    <span class="brand-mark" aria-hidden="true">S</span>
                <?php endif; ?>
                <span class="brand-name"><?= e($site['brand']['name']) ?></span>
            </a>
            <span class="footer-brand-tagline">ENTERTAINMENT PENTRU EVENIMENTE</span>
            <p>Momente speciale în <?= e($site['location']['service_area']) ?>.</p>
            <div class="footer-phone-list" aria-label="Numere de telefon">
                <?php foreach ([$site['contact']['phone'], $site['contact']['phone_secondary'] ?? ''] as $phone): ?>
                    <?php if ($phone !== ''): ?>
                        <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $phone)) ?>"><?= e($phone) ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php
            $footerSocials = [
                'facebook' => ['label' => 'Facebook', 'icon' => 'f'],
                'instagram' => ['label' => 'Instagram', 'icon' => '◎'],
            ];
            ?>
            <nav class="footer-social-links" aria-label="Rețele sociale">
                <?php foreach ($footerSocials as $platform => $social): ?>
                    <?php if (($site['social'][$platform] ?? '') !== ''): ?>
                        <a href="<?= e($site['social'][$platform]) ?>" target="_blank" rel="noopener noreferrer" aria-label="<?= e($social['label']) ?>"><?= e($social['icon']) ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </nav>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <p>&copy; <?= date('Y') ?> <?= e($site['brand']['name']) ?>. Toate drepturile rezervate.</p>
        </div>
    </div>
</footer>
