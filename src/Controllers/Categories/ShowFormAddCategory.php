<?php

declare(strict_types=1);

namespace App\Controllers\Categories;

use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;

class ShowFormAddCategory
{
    /** @var ResponseInterface */
    private $response;

    /** @var Engine */
    private $templateEngine;

    public function __construct(
        ResponseInterface $response,
        Engine $templateEngine
    )
    {
        $this->response = $response;
        $this->templateEngine = $templateEngine;
    }

    public function __invoke(): ResponseInterface
    {
        $response = $this->response->withHeader('Content-Type', 'text/html');
        $response->getBody()->write(
            $this->templateEngine->render('agregar-categoria')
        );

        return $response;
    }
}
