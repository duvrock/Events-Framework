<section class="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <p class="eyebrow"><span class="eyebrow-line"></span> Evenimente cu energie, în <?= e($site['location']['city']) ?></p>
            <h1><?= e($data['page']['h1']) ?></h1>
            <p class="hero-intro"><?= e($data['page']['intro']) ?></p>
            <div class="hero-actions">
                <a class="button" href="/contact/">Solicită o ofertă <span aria-hidden="true">↗</span></a>
                <?php if ($site['contact']['phone'] !== ''): ?>
                    <a class="button button-quiet" href="tel:<?= e(preg_replace('/[^0-9+]/', '', $site['contact']['phone'])) ?>">Sună acum</a>
                <?php endif; ?>
            </div>
            <p class="hero-note">Spune-ne ce eveniment organizezi și ce atmosferă îți dorești.</p>
        </div>
        <div class="hero-art">
            <video
                class="hero-video"
                autoplay
                muted
                loop
                playsinline
                preload="none"
                poster="/assets/images/wedding-dance-poster.jpg"
                data-src="/assets/video/wedding-dance.mp4"
                aria-hidden="true"
                tabindex="-1"
            ></video>
            <a class="hero-art-caption" href="https://www.pexels.com/video/people-dancing-at-a-wedding-party-20155165/" target="_blank" rel="noopener noreferrer">
                Video: Bryan Santos / Pexels
            </a>
        </div>
    </div>
    <?php
    $socialIconLabels = [
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'twitter' => 'X / Twitter',
        'pinterest' => 'Pinterest',
        'linkedin' => 'LinkedIn',
    ];
    $activeSocialPlatforms = array_filter(
        $socialIconLabels,
        static fn (string $platform): bool => ($site['social'][$platform] ?? '') !== '',
        ARRAY_FILTER_USE_KEY
    );
    if ($activeSocialPlatforms !== []):
    ?>
        <nav class="hero-social-links" aria-label="Rețele sociale">
            <?php foreach ($activeSocialPlatforms as $platform => $label): ?>
                <a class="social-link social-link--<?= e($platform) ?>" href="<?= e($site['social'][$platform]) ?>" target="_blank" rel="noopener noreferrer" aria-label="<?= e($label) ?>" title="<?= e($label) ?>">
                    <?php if ($platform === 'instagram'): ?>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="4"/><circle class="social-icon-dot" cx="17.5" cy="6.8" r="1"/></svg>
                    <?php else: ?>
                        <span aria-hidden="true"><?= $platform === 'facebook' ? 'f' : ($platform === 'twitter' ? '𝕏' : ($platform === 'pinterest' ? 'p' : 'in')) ?></span>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </nav>
    <?php endif; ?>
    <a class="scroll-cue" href="#servicii"><span aria-hidden="true">↓</span> Descoperă serviciile</a>
</section>

<section class="section services-section" id="servicii">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="eyebrow"><span class="eyebrow-line"></span> Serviciile noastre</p>
                <h2>Tot ce aduce evenimentul <span>la viață.</span></h2>
            </div>
            <p>Descoperă opțiunile de entertainment și alege ce se potrivește evenimentului tău.</p>
        </div>
    </div>
    <div class="service-grid">
        <?php
        $services = [
            [
                'number' => '01',
                'title' => 'Show-uri de breakdance',
                'text' => 'Momente spectaculoase de breakdance pentru nunți și evenimente.',
                'url' => '/show-uri-dans-nunti-evenimente-craiova/',
                'icon' => '✳',
            ],
            [
                'number' => '02',
                'title' => 'MC pentru evenimente',
                'text' => 'Prezentarea momentelor și coordonarea programului evenimentului.',
                'url' => '/mc-evenimente-craiova/',
                'icon' => '◉',
            ],
            [
                'number' => '03',
                'title' => 'DJ pentru evenimente',
                'text' => 'Muzică pentru nunți, petreceri private și alte ocazii speciale.',
                'url' => '/dj-evenimente-craiova/',
                'icon' => '♫',
            ],
            [
                'number' => '04',
                'title' => 'Petreceri pentru copii',
                'text' => 'Entertainment pentru petreceri aniversare și evenimente dedicate copiilor.',
                'url' => '/petreceri-copii-craiova/',
                'icon' => '✧',
            ],
        ];
        foreach ($services as $service):
            $isDjService = $service['number'] === '03';
        ?>
            <article class="service-card service-card--<?= e(match ($service['number']) {
                '01' => 'dance',
                '02' => 'mc',
                '03' => 'dj',
                default => 'kids',
            }) ?>" data-card-effect>
                <span class="service-number"><?= e($service['number']) ?></span>
            <span class="service-demo-label"><?= $isDjService ? 'Fotografie furnizată' : 'Fundal demonstrativ · înlocuibil' ?></span>
                <div class="service-card-content">
                    <span class="service-icon" aria-hidden="true"><?= e($service['icon']) ?></span>
                    <h3><?= e($service['title']) ?></h3>
                    <p><?= e($service['text']) ?></p>
                    <a class="service-card-link" href="<?= e($service['url']) ?>">Află mai multe <span aria-hidden="true">↗</span></a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section about-section" id="despre">
    <div class="container about-grid">
        <div class="about-visual">
            <div class="about-orbit about-orbit-one"></div>
            <div class="about-orbit about-orbit-two"></div>
            <div class="about-visual-center">
                <span class="about-visual-label">SHOWTIME</span>
                <span class="about-visual-city"><?= e($site['location']['city']) ?></span>
            </div>
            <span class="about-visual-caption">Grafică demonstrativă · fotografie reală de adăugat</span>
        </div>
        <div class="about-copy">
            <p class="eyebrow"><span class="eyebrow-line"></span> Despre ShowTime</p>
            <h2>Un eveniment reușit începe cu <span>alegerea potrivită.</span></h2>
            <p>Alege serviciile de care ai nevoie, apoi discutăm detaliile evenimentului tău: data, locația, publicul și atmosfera pe care vrei să o creezi.</p>
            <ul class="about-points">
                <li><span aria-hidden="true">✦</span> Patru servicii de entertainment, într-un singur loc</li>
                <li><span aria-hidden="true">✦</span> Opțiuni pentru evenimente în familie și petreceri private</li>
                <li><span aria-hidden="true">✦</span> Servicii în <?= e($site['location']['service_area']) ?></li>
            </ul>
            <a class="text-link" href="/contact/">Hai să vorbim despre evenimentul tău <span aria-hidden="true">↗</span></a>
        </div>
    </div>
</section>

<section class="event-strip" aria-label="Tipuri de evenimente">
    <div class="container event-strip-inner">
        <p>Ocazii speciale</p>
        <ul>
            <li>Nunți</li>
            <li>Botezuri</li>
            <li>Aniversări</li>
            <li>Evenimente private</li>
            <li>Petreceri pentru copii</li>
        </ul>
    </div>
</section>

<section class="section gallery-section">
    <div class="container">
        <div class="section-heading">
            <div>
                <p class="eyebrow"><span class="eyebrow-line"></span> Galerie</p>
                <h2>Atmosfera se vede <span>în momente.</span></h2>
            </div>
            <p>Galeria va prezenta fotografii și videoclipuri reale, după ce vor fi furnizate.</p>
        </div>
        <div class="gallery-placeholder">
            <span class="gallery-placeholder-icon" aria-hidden="true">✧</span>
            <p>Galeria foto și video va fi completată cu imagini reale de la evenimente.</p>
            <span>Fotografiile demonstrative nu sunt incluse în această versiune.</span>
        </div>
    </div>
</section>

<section class="section faq-section" id="intrebari">
    <div class="container faq-grid">
        <div>
            <p class="eyebrow"><span class="eyebrow-line"></span> Întrebări frecvente</p>
            <h2>Înainte să <span>ne scrii.</span></h2>
            <p class="faq-intro">Câteva răspunsuri utile pentru organizarea evenimentului.</p>
        </div>
        <div class="faq-list">
            <details>
                <summary>În ce zonă sunt disponibile serviciile?</summary>
                <p>Serviciile sunt prezentate pentru Craiova și împrejurimi. Menționează localitatea evenimentului când soliciți o ofertă.</p>
            </details>
            <details>
                <summary>Pot solicita unul sau mai multe servicii?</summary>
                <p>Da. Poți întreba despre unul sau mai multe dintre serviciile prezentate, iar detaliile se discută în funcție de eveniment.</p>
            </details>
            <details>
                <summary>Ce informații să includ în solicitare?</summary>
                <p>Tipul evenimentului, data aproximativă, localitatea și serviciul dorit ne ajută să înțelegem mai bine cererea.</p>
            </details>
        </div>
    </div>
</section>

<section class="closing-cta">
    <div class="container closing-cta-inner">
        <div>
            <p class="eyebrow"><span class="eyebrow-line"></span> Următorul pas</p>
            <h2>Hai să pregătim <span>un eveniment pe gustul tău.</span></h2>
            <p>Spune-ne câteva detalii și discutăm opțiunile potrivite.</p>
        </div>
        <a class="button button-light" href="/contact/">Solicită o ofertă <span aria-hidden="true">↗</span></a>
    </div>
</section>
