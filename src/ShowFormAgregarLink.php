<?php

declare(strict_types=1);

namespace App;

use League\Plates\Engine;
use PDO;
use Psr\Http\Message\ResponseInterface;

class ShowFormAgregarLink
{
    private $response;

    private $templateEngine;

    /**
     * @var PDO
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

    public function __invoke(): ResponseInterface
    {
        $stmt = $this->db->prepare('SELECT name FROM categories ORDER BY name ASC');
        $stmt->execute();
        $categorias = array_map(function ($category) {
            return $this->mapCategoryToSelectOption($category);
        }, $stmt->fetchAll());

        $response = $this->response->withHeader('Content-Type', 'text/html');
        $response->getBody()->write(
            $this->templateEngine->render('agregar-link', [
                'categorias' => $categorias,
            ])
        );

        return $response;
    }

    private function mapCategoryToSelectOption($category)
    {
        $name = $category['name'];

        $value = urlencode($name);

        return "<option value=$value>$name</option>";
    }
}