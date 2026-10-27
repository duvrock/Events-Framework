<header class="site-header">
    <div class="site-utility">
        <div class="container site-utility-inner" aria-label="Date de contact">
            <div class="site-contact-items">
                <?php if ($site['contact']['phone'] !== ''): ?>
                    <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $site['contact']['phone'])) ?>">
                        <span class="contact-icon" aria-hidden="true">⌕</span>
                        <span><?= e($site['contact']['phone']) ?></span>
                    </a>
                <?php else: ?>
                    <span class="site-contact-placeholder"><span class="contact-icon" aria-hidden="true">⌕</span> Telefon în curs de configurare</span>
                <?php endif; ?>
                <?php if ($site['contact']['email'] !== ''): ?>
                    <a href="mailto:<?= e($site['contact']['email']) ?>">
                        <span class="contact-icon" aria-hidden="true">✉</span>
                        <span><?= e($site['contact']['email']) ?></span>
                    </a>
                <?php else: ?>
                    <span class="site-contact-placeholder"><span class="contact-icon" aria-hidden="true">✉</span> Email în curs de configurare</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="site-nav-shell">
        <div class="container header-inner">
            <a class="brand" href="/" aria-label="<?= e($site['brand']['name']) ?> — pagina principală">
                <?php if (!empty($site['brand']['logo'])): ?>
                    <img class="brand-logo" src="<?= e($site['brand']['logo']) ?>" alt="">
                <?php else: ?>
                    <span class="brand-mark" aria-hidden="true">S</span>
                <?php endif; ?>
                <span class="brand-name"><?= e($site['brand']['name']) ?></span>
            </a>

            <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
                <span class="menu-toggle-label">Meniu</span>
                <span class="menu-toggle-icon" aria-hidden="true"></span>
            </button>

            <nav class="primary-navigation" id="primary-navigation" aria-label="Navigare principală">
                <a href="/#servicii">Servicii</a>
                <a href="/#despre">Despre</a>
                <a href="/#intrebari">Întrebări</a>
                <a class="nav-contact-link" href="/contact/">Contact</a>
                <a class="button button-small" href="/contact/">Solicită o ofertă</a>
            </nav>
        </div>
    </div>
</header>
