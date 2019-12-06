<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeImmutable;
use DateTimeZone;
use Exception;
use RuntimeException;

final class Category
{
    /** @var int */
    private $cid;

    /** @var string */
    private $name;

    /** @var DateTimeImmutable */
    private $created;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        $this->created = new DateTimeImmutable('now', new DateTimeZone('UTC'));
    }

    /**
     * @param array $row
     * @return Category
     * @throws Exception
     */
    public static function fromDb(array $row): Category
    {
        $category = new Category();

        $category->cid = $row['cid'];
        $category->name = $row['name'];
        $category->created = new DateTimeImmutable($row['date']);

        return $category;
    }

    public function toDb(): array
    {
        return [
            'name' => $this->name,
            'date' => $this->created->format('Y-m-d H:i:s'),
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function newCategory(array $data): Category
    {
        self::validateNewCategoryData($data);

        $category = new Category();
        $category->name = $data['name'];

        return $category;
    }

    private static function validateNewCategoryData(array $data): void
    {
        $messages = [];
        if (!array_key_exists('name', $data)) {
            $messages['name'] = 'falta el nombre';
        }

        if (!empty($messages)) {
            $e = new RuntimeException("Validation failure");
            throw $e;
        }
    }
}
