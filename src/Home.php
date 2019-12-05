<?php

declare(strict_types=1);

namespace App;

use League\Plates\Engine;
use PDO;
use Psr\Http\Message\ResponseInterface;

class Home
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var Engine
     */
    private $templateEngine;

    /**
     * @var PDO
     */
    private $db;

    public function __construct(
        ResponseInterface $response,
        Engine $templateEngine,
        PDO $pdo
    )
    {
        $this->response = $response;
        $this->templateEngine = $templateEngine;
        $this->db = $pdo;
    }

    public function __invoke(): ResponseInterface
    {
        $stmt = $this->db->prepare('SELECT name FROM categories ORDER BY name ASC');
        $stmt->execute();
        $categorias = array_map(function ($category) {
            return $this->mapCategoryToHTML($category);
        }, $stmt->fetchAll());

        $stmt = $this->db->prepare('SELECT url, title FROM links ORDER BY title ASC');
        $stmt->execute();
        $links = array_map(function ($link) {
            return $this->mapLinktoHTML($link);
        }, $stmt->fetchAll());

        $response = $this->response->withHeader('Content-Type', 'text/html');
        $response->getBody()->write(
            $this->templateEngine->render('home', [
                'categorias' => $categorias,
                'links' => $links,
            ])
        );

        return $response;
    }

    private function mapCategoryToHTML($category)
    {
        $name = $category['name'];
        $href = "/categorias/" . urlencode($name);

        global $selectedName;

        $class = "'list-group-item list-group-item-action'";
        if (isset($selectedName)) {
            if ($name === $selectedName) {
                $class = "'list-group-item list-group-item-action active'";
            }
        }

        return "<a class=$class href=$href>$name</a>";
    }

    private function mapLinktoHTML($link)
    {
        $class = "'list-group-item list-group-item-action'";
        $href = urldecode($link['url']);
        $title = empty($link['title']) ? $link['url'] : $link['title'];

        return "<a class=$class href=$href>$title</a>";
    }
}
