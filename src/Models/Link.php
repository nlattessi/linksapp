<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeImmutable;
use DateTimeZone;
use Exception;
use RuntimeException;

final class Link
{
    /** @var int */
    private $lid;

    /** @var string */
    private $url;

    /** @var string */
    private $title;

    /** @var string */
    private $category;

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
     * @return Link
     * @throws Exception
     */
    public static function fromDb(array $row): Link
    {
        $link = new Link();

        $link->lid = $row['lid'];
        $link->url = $row['url'];
        $link->title = $row['title'];
        $link->category = $row['category'];
        $link->created = new DateTimeImmutable($row['date']);

        return $link;
    }

    public function toDb(): array
    {
        return [
            'url' => $this->url,
            'title' => $this->title,
            'category' => $this->category,
            'date' => $this->created->format('Y-m-d H:i:s'),
        ];
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return empty($this->title) ? $this->url : $this->title;
    }

    public static function newLink(array $data): Link
    {
        self::validateNewLinkData($data);

        $link = new Link();
        $link->url = $data['url'];
        $link->title = $data['title'];
        $link->category = $data['category'];

        return $link;
    }

    private static function validateNewLinkData(array $data): void
    {
        $messages = [];
        if (!array_key_exists('url', $data)) {
            $messages['url'] = 'falta url';
        }
        if (!filter_var($data['url'], FILTER_VALIDATE_URL)) {
            $messages['url'] = 'La url ingresada no es una url válida';
        }
        if (!array_key_exists('category', $data)) {
            $messages['category'] = 'falta categoria';
        }

        if (!empty($messages)) {
            $e = new RuntimeException("Validation failure");
            throw $e;
        }
    }
}
