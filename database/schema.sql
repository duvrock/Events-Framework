CREATE TABLE IF NOT EXISTS admin_users (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    failed_attempts TINYINT UNSIGNED NOT NULL DEFAULT 0,
    locked_until DATETIME NULL,
    last_login_at DATETIME NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS pages (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(120) NOT NULL UNIQUE,
    title VARCHAR(160) NOT NULL,
    meta_description VARCHAR(320) NOT NULL,
    h1 VARCHAR(160) NOT NULL,
    intro VARCHAR(700) NOT NULL,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS contact_requests (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    phone VARCHAR(40) NOT NULL,
    email VARCHAR(190) NULL,
    event_type VARCHAR(80) NOT NULL,
    desired_service VARCHAR(100) NOT NULL,
    event_date DATE NULL,
    locality VARCHAR(120) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'in_progress', 'closed') NOT NULL DEFAULT 'new',
    submitted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_contact_requests_submitted_at (submitted_at),
    INDEX idx_contact_requests_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS social_links (
    platform VARCHAR(24) NOT NULL PRIMARY KEY,
    url VARCHAR(2048) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO pages (slug, title, meta_description, h1, intro)
VALUES
    ('home', 'Show-uri pentru evenimente și DJ în Craiova', 'Show-uri pentru evenimente și DJ în Craiova: momente de dans, DJ și entertainment pentru nunți, botezuri și petreceri. Cere o ofertă ShowTime.', 'Show-uri și DJ pentru evenimente în Craiova', 'Organizezi o nuntă, un botez sau o petrecere? Alege show-uri de dans și DJ în Craiova pentru momente memorabile și o atmosferă potrivită evenimentului tău.'),
    ('show-uri-dans-nunti-evenimente-craiova', 'Show-uri de dans pentru nunți în Craiova', 'Show-uri de dans pentru nunți și evenimente în Craiova și împrejurimi.', 'Show-uri de dans pentru nunți și evenimente', 'Descoperă opțiunile de show de dans pentru evenimentul tău.'),
    ('mc-evenimente-craiova', 'MC pentru evenimente în Craiova', 'Servicii de MC pentru nunți, botezuri și evenimente private în Craiova.', 'MC pentru nunți și evenimente', 'Discutăm despre prezentarea momentelor și coordonarea programului evenimentului.'),
    ('dj-evenimente-craiova', 'DJ pentru evenimente în Craiova', 'Servicii DJ pentru nunți și evenimente în Craiova și împrejurimi.', 'DJ pentru nunți și evenimente', 'Spune-ne ce eveniment organizezi și ce muzică îți dorești.'),
    ('petreceri-copii-craiova', 'Petreceri pentru copii în Craiova', 'Entertainment pentru petreceri de copii în Craiova și împrejurimi.', 'Petreceri și entertainment pentru copii', 'Discutăm despre petrecerea copiilor și opțiunile de entertainment disponibile.');
