<?php

declare(strict_types=1);

namespace App;

use League\Plates\Engine;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AgregarLink
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
     * @var DatabaseInterface
     */
    private $db;

    public function __construct(
        ResponseInterface $response,
        Engine $templateEngine,
        PDO $db
    )
    {
        $this->response = $response;
        $this->templateEngine = $templateEngine;
        $this->db = $db;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        if (empty($body['url'])) {
            die('falta url');
        }
        if (!filter_var($body['url'], FILTER_VALIDATE_URL)) {
            die("La url ingresada no es una url válida");
        }

        $title = $body['title'] ?? null;

        $categoria = $body['category'] ?? null;
        if (empty($body['category'])) {
            die('falta categoria');
        }

        $stmt = $this->db->prepare('SELECT cid FROM categories WHERE name = ? LIMIT 1');
        $stmt->execute([$categoria]);
        $cid = $stmt->fetch();
        if (empty($cid)) {
            die("Categoria $categoria no válida");
        }

        $url = $body['url'];
        $date = Date("Y-m-d H:i:s");

        $this->db->prepare('INSERT INTO links (url, title, cid, date) VALUES (?, ?, ?, ?)')->execute([$url, $title, $cid['cid'], $date]);

        return $this->response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }
}
