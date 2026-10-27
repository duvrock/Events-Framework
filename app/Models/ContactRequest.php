<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

final class ContactRequest
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function recent(int $limit = 10): array
    {
        $limit = max(1, min($limit, 50));
        $statement = $this->db->query(
            'SELECT id, name, phone, email, event_type, desired_service, event_date, locality, status, submitted_at
             FROM contact_requests ORDER BY submitted_at DESC LIMIT ' . $limit
        );

        return $statement->fetchAll();
    }
}
