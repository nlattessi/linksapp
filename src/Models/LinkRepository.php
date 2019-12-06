<?php

declare(strict_types=1);

namespace App\Models;

final class LinkRepository extends BaseRepository
{
    /**
     * @param string $name
     * @return Link[]
     */
    public function getAllWhereCategoryNameIs(string $name): array
    {
        $sql = 'SELECT l.*, c.name AS category FROM links l INNER JOIN categories c ON l.cid = c.cid WHERE c.name = ? ORDER BY title ASC';

        return $this->getLinks($sql, [$name]);
    }

    /**
     * @return Link[]
     */
    public function getAll(): array
    {
        $sql = 'SELECT l.*, c.name AS category FROM links l INNER JOIN categories c ON l.cid = c.cid ORDER BY title ASC';

        return $this->getLinks($sql);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return Link[]
     */
    private function getLinks(string $sql, array $params = []): array
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();

        $results = array_map(function ($row) {
            return Link::fromDb($row);
        }, $rows);

        return $results;
    }

    public function add(Link $link)
    {
        $data = $link->toDb();

        $sql = 'INSERT INTO links (url, title, cid, date) VALUES (:url, :title, (SELECT cid FROM categories WHERE name = :category), :date)';
        $this->db->prepare($sql)->execute($data);
    }
}