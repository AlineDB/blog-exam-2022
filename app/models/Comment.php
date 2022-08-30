<?php

namespace Blog\Models;

class Comment extends Model
{
//tous les récupérer
    public function get(): array
    {
        $sql = <<<SQL
                SELECT c.id,
                       c.body, 
                       c.author_id, 
                       c.created_at,
                       c.updated_at
                FROM comments c
                JOIN authors a on c.author_id = a.id
                ORDER BY c.updated_at DESC
            SQL;

        return $this->pdo_connection->query($sql)->fetchAll();
    }

    //récupérer selon l'author

    public function find_by_authors(): array
    {
        $sql = <<<SQL
                SELECT c.id,
                       c.body, 
                       c.author_id, 
                       c.created_at,
                       c.updated_at
                FROM comments c
                JOIN authors a on c.author_id = a.id
                GROUP BY a.id
                ORDER BY c.updated_at DESC

            SQL;

        return $this->pdo_connection->query($sql)->fetchAll();
    }

    //compte le nombre par authors
    public function count_by_author(string $slug): string
    {
        $sql = <<<SQL
                SELECT count(c.id) 
                FROM comments c
                JOIN authors a on c.author_id = a.id
                WHERE a.slug = :slug;
            SQL;
        $statement = $this->pdo_connection->prepare($sql);
        $statement->execute([':slug' => $slug]);

        return $statement->fetchColumn();
    }

}

