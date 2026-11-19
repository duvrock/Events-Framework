# Events Framework

Site PHP pentru ShowTime Craiova, cu pagini publice statice și conținut scris direct în template-urile PHP. Aplicația nu folosește bază de date și nu necesită extensii PDO sau un server MySQL.

## Cerințe

- PHP 8.3 sau mai nou
- Apache cu `mod_rewrite` activat, sau serverul integrat PHP pentru dezvoltare locală

## Rulare locală

Din directorul proiectului, pornește serverul PHP integrat:

```powershell
php -S localhost:8000 -t public public/index.php
```

Deschide apoi `http://localhost:8000/`. În producție, configurează `public/` ca document root în Apache și activează overrides pentru `.htaccess`.

## Editarea conținutului

- Textele, titlurile și metadatele paginii principale sunt în `templates/pages/home.php`.
- Pagina de contact este în `templates/pages/contact.php`; pentru moment oferă contact direct prin telefon, fără formular sau stocare de solicitări.
- Pagina de show-uri este în `templates/pages/breakdance.php`.
- Numele, telefoanele, zona deservită și aspectul general se configurează în `config/site.php`.
- Antetul și subsolul comune sunt în `templates/components/`.

Zona de administrare este dezactivată. URL-urile `/admin/` și cele asociate răspund cu pagina 404. Pentru a modifica textele, editează direct template-urile PHP.

## Resurse media

Bannerul principal folosește un clip de 720p de Bryan Santos, găzduit local în `public/assets/video/wedding-dance.mp4`, cu posterul `public/assets/images/wedding-dance-poster.jpg`. Sursa clipului: [Pexels](https://www.pexels.com/video/people-dancing-at-a-wedding-party-20155165/). Clipul pornește fără sunet; nu este încărcat când browserul indică reducerea mișcării sau economisirea datelor.

Imaginea `public/assets/images/mc-event.jpg` îl prezintă pe MC-ul programului cultural de la Festivalul Ambasadelor din Praga. Fotografie de [Mojmir Churavy](https://commons.wikimedia.org/wiki/User:Mojmir_Churavy), disponibilă sub [CC0 1.0](https://creativecommons.org/publicdomain/zero/1.0/); [pagina fișierului](https://commons.wikimedia.org/wiki/File:Festival_of_Embassies_Prague_2022_C.jpg).

## Verificare

- Sintaxă PHP: `Get-ChildItem -Path . -Filter *.php -Recurse | ForEach-Object { php -l $_.FullName }`
- Verificare manuală în browser pentru `/`, `/contact/`, `/show-uri-dans-nunti-evenimente-craiova/` și o adresă inexistentă.
