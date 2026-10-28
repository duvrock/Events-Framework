<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Models\ContactRequest;
use App\Models\Page;
use App\Models\SocialLinks;
use RuntimeException;

final class HomeController
{
    public static function contact(array $site, string $method): void
    {
        $fields = [
            'name' => '',
            'phone' => '',
            'email' => '',
            'event_type' => '',
            'desired_service' => '',
            'event_date' => '',
            'locality' => '',
            'message' => '',
        ];
        $error = '';
        $submitted = false;

        if (isset($_SESSION['contact_success'])) {
            unset($_SESSION['contact_success']);
            $submitted = true;
        }

        if ($method === 'POST') {
            foreach ($fields as $field => $_value) {
                $value = $_POST[$field] ?? '';
                $fields[$field] = is_string($value) ? trim($value) : '';
            }

            if (!csrf_is_valid($_POST['csrf_token'] ?? null)) {
                http_response_code(403);
                $error = 'Sesiunea formularului a expirat. Reîncarcă pagina și încearcă din nou.';
            } elseif (is_string($_POST['website'] ?? null) && trim($_POST['website']) !== '') {
                $_SESSION['contact_success'] = true;
                redirect('/contact/');
            } else {
                $error = self::validateContactRequest($fields);
                if ($error === '') {
                    (new ContactRequest(Database::connection()))->create([
                        'name' => $fields['name'],
                        'phone' => $fields['phone'],
                        'email' => $fields['email'] !== '' ? $fields['email'] : null,
                        'event_type' => $fields['event_type'],
                        'desired_service' => $fields['desired_service'],
                        'event_date' => $fields['event_date'] !== '' ? $fields['event_date'] : null,
                        'locality' => $fields['locality'],
                        'message' => $fields['message'],
                    ]);
                    $_SESSION['contact_success'] = true;
                    redirect('/contact/');
                }
            }
        }

        render_page('contact', [
            'title' => 'Contact și ofertă pentru eveniment | ShowTime Craiova',
            'description' => 'Contactează ShowTime Craiova pentru show-uri de dans, DJ, MC și petreceri pentru copii. Sună la +40 761 657 045 sau +40 731 251 289.',
            'canonical' => trim((string) $site['brand']['url']) !== ''
                ? rtrim((string) $site['brand']['url'], '/') . '/contact/'
                : '',
            'fields' => $fields,
            'error' => $error,
            'submitted' => $submitted,
            'csrfToken' => csrf_token(),
        ], $site);
    }

    public static function breakdance(array $site): void
    {
        $description = 'Show nunți Craiova și momente artistice de breakdance pentru nuntă, botez, majorat și evenimente corporate. Cere o ofertă personalizată pentru evenimentul tău.';

        render_page('breakdance', [
            'title' => 'Show nunți Craiova | Momente artistice',
            'description' => $description,
            'canonical' => trim((string) $site['brand']['url']) !== ''
                ? rtrim((string) $site['brand']['url'], '/') . '/show-uri-dans-nunti-evenimente-craiova/'
                : '',
            'structuredData' => [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => 'Show-uri de breakdance și momente artistice în Craiova',
                'description' => $description,
                'serviceType' => 'Show de breakdance pentru nunți și evenimente',
                'areaServed' => [
                    '@type' => 'City',
                    'name' => $site['location']['city'],
                ],
                'provider' => [
                    '@type' => 'Organization',
                    'name' => $site['brand']['name'],
                ],
            ],
        ], $site);
    }

    public static function index(array $site): void
    {
        $page = (new Page(Database::connection()))->findBySlug('home');
        if ($page === null) {
            throw new RuntimeException('The home page has not been seeded in the database.');
        }

        $canonical = trim((string) $site['brand']['url']);
        if ($canonical !== '') {
            $canonical = rtrim($canonical, '/') . '/';
        }

        $site['social'] = array_merge(
            $site['social'],
            (new SocialLinks(Database::connection()))->all()
        );

        render_page('home', [
            'title' => $page['title'],
            'description' => $page['meta_description'],
            'canonical' => $canonical,
            'page' => $page,
        ], $site);
    }

    private static function validateContactRequest(array $fields): string
    {
        $limits = [
            'name' => 120,
            'phone' => 40,
            'event_type' => 80,
            'desired_service' => 100,
            'locality' => 120,
            'message' => 5000,
        ];

        foreach ($limits as $field => $limit) {
            $length = preg_match_all('/./us', $fields[$field]);
            if ($fields[$field] === '' || $length === false || $length > $limit) {
                return 'Completează câmpurile obligatorii și verifică lungimea textelor.';
            }
        }

        if (!preg_match('/^[+0-9][0-9\s().-]{5,39}$/', $fields['phone'])) {
            return 'Introdu un număr de telefon valid.';
        }

        if ($fields['email'] !== '' && (strlen($fields['email']) > 190 || filter_var($fields['email'], FILTER_VALIDATE_EMAIL) === false)) {
            return 'Introdu o adresă de email validă sau lasă câmpul necompletat.';
        }

        if ($fields['event_date'] !== '') {
            $date = \DateTimeImmutable::createFromFormat('!Y-m-d', $fields['event_date']);
            if ($date === false || $date->format('Y-m-d') !== $fields['event_date']) {
                return 'Introdu o dată validă pentru eveniment.';
            }
        }

        return '';
    }
}
