<?php

declare(strict_types=1);

namespace App\Traits;

use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;

trait TemplateEngineTrait
{
    protected function renderHtml(ResponseInterface $response, Engine $engine, string $templateName, array $data = []): ResponseInterface
    {
        $response = $response->withHeader('Content-Type', 'text/html');

        $response->getBody()->write(
            $engine->render($templateName, $data)
        );

        return $response;
    }
}
