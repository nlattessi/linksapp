<?php

declare(strict_types=1);

namespace App;

use League\Plates\Engine;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AgregarCategoria
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

        if (empty($body['name'])) {
            die('falta nombre');
        }

        $name = $body['name'];
        $date = Date("Y-m-d H:i:s");

        $this->db->prepare('INSERT INTO categories (name, date) VALUES (?, ?)')->execute([$name, $date]);

        return $this->response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }
}
