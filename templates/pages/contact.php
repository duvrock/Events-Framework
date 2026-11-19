<?php
$pageTitle = 'Contact și ofertă pentru eveniment | ShowTime Craiova';
$pageDescription = 'Contactează ShowTime Craiova pentru show-uri de dans, DJ, MC și petreceri pentru copii. Sună la +40 761 657 045 sau +40 731 251 289.';
$canonical = trim((string) $site['brand']['url']) !== ''
    ? rtrim((string) $site['brand']['url'], '/') . '/contact/'
    : '';
$phones = [
    $site['contact']['phone'],
    $site['contact']['phone_secondary'] ?? '',
];
?>
<section class="contact-page">
    <div class="contact-hero">
        <img
            class="contact-hero-image"
            src="/assets/images/breakdance-show-1.jpg"
            alt="Show de breakdance pe scenă, într-un eveniment cu public și lumini"
            fetchpriority="high"
        >
        <div class="contact-hero-shade" aria-hidden="true"></div>
        <div class="container contact-hero-inner">
            <p class="eyebrow"><span class="eyebrow-line"></span> Entertainment pentru evenimente în Craiova</p>
            <h1>Hai să vorbim despre evenimentul tău</h1>
            <p>Sună-ne direct pentru a discuta opțiunile potrivite evenimentului tău.</p>
        </div>
    </div>

    <div class="section contact-main">
        <div class="container contact-layout">
            <aside class="contact-details">
                <p class="eyebrow"><span class="eyebrow-line"></span> Contact direct</p>
                <h2>Suntem aici să te ajutăm.</h2>
                <p>Contactează-ne pentru show-uri de dans, DJ, MC sau entertainment pentru petreceri.</p>
                <div class="contact-phone-list">
                    <?php foreach ($phones as $phone): ?>
                        <?php if ($phone !== ''): ?>
                            <a class="contact-phone-card" href="tel:<?= e(preg_replace('/[^0-9+]/', '', $phone)) ?>">
                                <span class="contact-phone-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" focusable="false">
                                        <path d="M7.2 3.8 9.5 3.3c.7-.2 1.4.2 1.7.9l1.1 2.5c.3.7.1 1.5-.5 2l-1.4 1.1a14 14 0 0 0 5.8 5.8l1.1-1.4c.5-.6 1.3-.8 2-.5l2.5 1.1c.7.3 1.1 1 .9 1.7l-.5 2.3c-.2.8-.9 1.3-1.7 1.3C10 20.1 3.9 14 3.9 5.5c0-.8.5-1.5 1.3-1.7Z"/>
                                    </svg>
                                </span>
                                <span><small>Sună-ne</small><strong><?= e($phone) ?></strong></span>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <p class="contact-service-area">📍 Servicii în <?= e($site['location']['service_area']) ?></p>
            </aside>
            <div class="contact-form-panel">
                <h2>Solicită o ofertă</h2>
                <p class="contact-form-intro">Alege numărul de telefon și sună-ne pentru a discuta detaliile evenimentului.</p>
                <?php foreach ($phones as $phone): ?>
                    <?php if ($phone !== ''): ?>
                        <p><a class="button" href="tel:<?= e(preg_replace('/[^0-9+]/', '', $phone)) ?>">Sună la <?= e($phone) ?></a></p>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
