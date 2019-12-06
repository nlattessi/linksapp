<?php

declare(strict_types=1);

namespace App\Models;

final class CategoryRepository extends BaseRepository
{
    public function getAll(): array
    {
        $sql = 'SELECT * FROM categories ORDER BY name ASC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $results = array_map(function ($row) {
            return Category::fromDb($row);
        }, $rows);

        return $results;
    }

    public function add(Category $category)
    {
        $data = $category->toDb();

        $sql = 'INSERT INTO categories (name, date) VALUES (:name, :date)';
        $this->db->prepare($sql)->execute($data);
    }
}
