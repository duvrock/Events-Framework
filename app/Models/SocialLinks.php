<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

final class SocialLinks
{
    public const PLATFORMS = [
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'twitter' => 'X / Twitter',
        'pinterest' => 'Pinterest',
        'linkedin' => 'LinkedIn',
    ];

    public function __construct(private readonly PDO $db)
    {
    }

    public function all(): array
    {
        $links = array_fill_keys(array_keys(self::PLATFORMS), '');
        $statement = $this->db->query('SELECT platform, url FROM social_links');

        foreach ($statement->fetchAll() as $row) {
            if (array_key_exists($row['platform'], $links)) {
                $links[$row['platform']] = $row['url'];
            }
        }

        return $links;
    }

    public function save(array $links): void
    {
        $this->db->beginTransaction();
        try {
            $statement = $this->db->prepare(
                'INSERT INTO social_links (platform, url) VALUES (:platform, :url)
                ON DUPLICATE KEY UPDATE url = VALUES(url)'
            );

            foreach (self::PLATFORMS as $platform => $_label) {
                $statement->execute([
                    'platform' => $platform,
                    'url' => $links[$platform],
                ]);
            }

            $this->db->commit();
        } catch (\Throwable $error) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            throw $error;
        }
    }
}
