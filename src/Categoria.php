<?php

declare(strict_types=1);

namespace App;

use League\Plates\Engine;
use PDO;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Categoria
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

    public function __invoke(RequestInterface $request, $xxx): ResponseInterface
    {
        $categoria = $request->getAttribute('categoria');

        $stmt = $this->db->prepare('SELECT name FROM categories ORDER BY name ASC');
        $stmt->execute();
        $categorias = array_map(function ($category) use ($categoria) {
            return $this->mapCategoryToHTML($category, $categoria);
        }, $stmt->fetchAll());

        $stmt = $this->db->prepare('SELECT cid FROM categories WHERE name = ? LIMIT 1');
        $stmt->execute([$categoria]);
        $cid = $stmt->fetch();

        $stmt = $this->db->prepare('SELECT url, title FROM links WHERE cid = ? ORDER BY title ASC');
        $stmt->execute([$cid['cid']]);
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

    private function mapCategoryToHTML($category, $selectedName)
    {
        $name = $category['name'];
        $href = "/?name=" . urlencode($name);

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
        $title = $link['title'];

        return "<a class=$class href=$href>$title</a>";
    }
}