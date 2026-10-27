<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

final class Page
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function findBySlug(string $slug): ?array
    {
        $statement = $this->db->prepare(
            'SELECT id, slug, title, meta_description, h1, intro
             FROM pages WHERE slug = :slug LIMIT 1'
        );
        $statement->execute(['slug' => $slug]);
        $page = $statement->fetch();

        return is_array($page) ? $page : null;
    }

    public function all(): array
    {
        return $this->db->query(
            'SELECT id, slug, title, meta_description, h1, intro, updated_at
             FROM pages ORDER BY id'
        )->fetchAll();
    }

    public function update(int $id, array $fields): void
    {
        $statement = $this->db->prepare(
            'UPDATE pages
             SET title = :title,
                 meta_description = :meta_description,
                 h1 = :h1,
                 intro = :intro
             WHERE id = :id'
        );
        $statement->execute($fields + ['id' => $id]);
    }
}
