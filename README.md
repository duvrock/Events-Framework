# Events Framework

Frameworkul site-ului ShowTime Craiova.

Aplicație PHP cu arhitectură MVC simplă și MySQL. Directorul `public/` trebuie configurat ca document root în Apache; directoarele `app/`, `config/`, `database/`, `bin/` și `templates/` trebuie să rămână în afara rădăcinii publice.

## Cerințe

- PHP 8.3 sau mai nou, cu extensiile PDO și `pdo_mysql`
- MySQL/MariaDB (XAMPP local este potrivit pentru dezvoltare)
- Apache cu `mod_rewrite` activat pentru URL-uri curate

## Clipul din banner

Bannerul principal folosește un clip de 720p de Bryan Santos, găzduit local în `public/assets/video/wedding-dance.mp4`, cu posterul `public/assets/images/wedding-dance-poster.jpg`. Sursa clipului: [Pexels](https://www.pexels.com/video/people-dancing-at-a-wedding-party-20155165/). Clipul pornește fără sunet; nu este încărcat când browserul indică reducerea mișcării sau economisirea datelor.

## Configurare locală

1. Creează baza de date MySQL `evenimente` cu collation `utf8mb4_unicode_ci`.
2. Pentru comenzile PHP CLI în PowerShell, setează variabilele de mediu. XAMPP folosește adesea `root` fără parolă local; dacă instalarea ta diferă, adaptează valorile:
   ```powershell
   $env:DB_HOST = "127.0.0.1"
   $env:DB_PORT = "3306"
   $env:DB_NAME = "evenimente"
   $env:DB_USER = "root"
   $env:DB_PASSWORD = ""
   ```
   Setările pentru site trebuie definite și în mediul procesului Apache/PHP înainte de pornire (sau în configurația privată a hostingului); variabilele setate într-o fereastră PowerShell nu sunt preluate automat de Apache.
3. Setările sunt:
   - `DB_HOST` (implicit `127.0.0.1`)
   - `DB_PORT` (implicit `3306`)
   - `DB_NAME` (implicit `evenimente`)
   - `DB_USER`
   - `DB_PASSWORD`
4. Rulează schema: `php bin\migrate.php`
5. Creează primul administrator prin variabilele `ADMIN_EMAIL` și `ADMIN_PASSWORD` (minimum 16 caractere), apoi rulează `php bin\create-admin.php`. Nu pune credențialele în fișiere servite de Apache și elimină `ADMIN_PASSWORD` din mediu după creare.
6. Configurează în Apache `public/` ca document root și activează overrides pentru `.htaccess`.
7. Deschide `/admin/login/` pentru administrare.

Nu trimite și nu salva credențiale reale în repository. Pentru hosting, folosește un utilizator MySQL dedicat aplicației, cu acces doar la baza `evenimente`, nu contul root.

## Rute disponibile în această etapă

- `/` — pagina principală
- `/contact/` — pagina și formularul de contact
- `/show-uri-dans-nunti-evenimente-craiova/` — pagina show-urilor de breakdance
- `/admin/login/` — autentificare administrator
- `/admin/` — pagini și solicitări recente
- `/admin/pages/{slug}/` — editarea conținutului unei pagini
- `/admin/settings/social-links/` — administrarea linkurilor Facebook, Instagram, X/Twitter, Pinterest și LinkedIn

Linkurile sociale sunt salvate în tabelul `social_links` și afișate ca iconițe verticale în partea dreaptă jos a bannerului principal, doar când au fost configurate. Rulează `php bin\migrate.php` pentru a crea tabelul pe o instalare existentă.

Solicitările trimise prin formularul de contact sunt stocate în `contact_requests` și apar în zona administrată. Numerele de telefon se configurează în `config/site.php`.

## Teste locale

- Sintaxă PHP: `Get-ChildItem -Path . -Filter *.php -Recurse | ForEach-Object { php -l $_.FullName }`
- Schema și conexiunea: `php bin/migrate.php`
- Autentificare și rutare: verifică `/admin/login/`, `/admin/` și `/admin/pages/home/` în browser după configurarea DB.
- Pentru verificarea redirectului HTTPS, codurilor HTTP și URL-urilor Apache este necesar un server Apache local/hosting; serverul integrat PHP nu aplică `.htaccess`.
