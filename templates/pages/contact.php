<?php
$fields = $data['fields'];
$error = $data['error'];
$submitted = $data['submitted'];
$csrfToken = $data['csrfToken'];
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
            <p>Sună-ne direct sau trimite-ne câteva detalii și revenim pentru a discuta opțiunile potrivite.</p>
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
                <p class="contact-form-intro">Câmpurile marcate cu * sunt obligatorii.</p>

                <?php if ($error !== ''): ?>
                    <p class="form-message form-error" role="alert"><?= e($error) ?></p>
                <?php elseif ($submitted): ?>
                    <p class="form-message form-success" role="status">Mulțumim! Solicitarea ta a fost trimisă. Te vom contacta pentru a discuta detaliile evenimentului.</p>
                <?php endif; ?>

                <form class="contact-form" method="post" action="/contact/">
                    <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">
                    <div class="contact-honeypot" aria-hidden="true">
                        <label for="contact-website">Nu completa acest câmp</label>
                        <input id="contact-website" type="text" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="contact-form-grid">
                        <div class="contact-field">
                            <label for="contact-name">Nume *</label>
                            <input id="contact-name" name="name" type="text" maxlength="120" autocomplete="name" required value="<?= e($fields['name']) ?>">
                        </div>
                        <div class="contact-field">
                            <label for="contact-phone">Telefon *</label>
                            <input id="contact-phone" name="phone" type="tel" maxlength="40" autocomplete="tel" required value="<?= e($fields['phone']) ?>">
                        </div>
                        <div class="contact-field">
                            <label for="contact-email">Email</label>
                            <input id="contact-email" name="email" type="email" maxlength="190" autocomplete="email" value="<?= e($fields['email']) ?>">
                        </div>
                        <div class="contact-field">
                            <label for="contact-event-type">Tip eveniment *</label>
                            <select id="contact-event-type" name="event_type" required>
                                <option value="">Alege tipul evenimentului</option>
                                <?php foreach (['Nuntă', 'Botez', 'Majorat', 'Eveniment corporate', 'Petrecere privată', 'Petrecere pentru copii', 'Alt eveniment'] as $eventType): ?>
                                    <option value="<?= e($eventType) ?>" <?= $fields['event_type'] === $eventType ? 'selected' : '' ?>><?= e($eventType) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="contact-field">
                            <label for="contact-service">Serviciu dorit *</label>
                            <select id="contact-service" name="desired_service" required>
                                <option value="">Alege un serviciu</option>
                                <?php foreach (['Show de dans / breakdance', 'DJ', 'MC', 'Petrecere pentru copii', 'Mai multe servicii', 'Alt serviciu'] as $service): ?>
                                    <option value="<?= e($service) ?>" <?= $fields['desired_service'] === $service ? 'selected' : '' ?>><?= e($service) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="contact-field">
                            <label for="contact-date">Data evenimentului</label>
                            <input id="contact-date" name="event_date" type="date" value="<?= e($fields['event_date']) ?>">
                        </div>
                        <div class="contact-field contact-field--full">
                            <label for="contact-locality">Localitate *</label>
                            <input id="contact-locality" name="locality" type="text" maxlength="120" autocomplete="address-level2" required value="<?= e($fields['locality']) ?>">
                        </div>
                        <div class="contact-field contact-field--full">
                            <label for="contact-message">Detalii despre eveniment *</label>
                            <textarea id="contact-message" name="message" rows="5" maxlength="5000" required><?= e($fields['message']) ?></textarea>
                        </div>
                    </div>

                    <button class="button" type="submit">Trimite solicitarea <span aria-hidden="true">↗</span></button>
                </form>
            </div>
        </div>
    </div>
</section>
