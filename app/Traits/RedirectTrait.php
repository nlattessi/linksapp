<?php

declare(strict_types=1);

namespace App\Traits;

use Psr\Http\Message\ResponseInterface;

trait RedirectTrait
{
    protected function redirectToHome(ResponseInterface $response): ResponseInterface
    {
        return $response->withHeader('Location', '/')->withStatus(302);
    }

    protected function redirectToCategory(ResponseInterface $response, string $category)
    {
        return $response->withHeader('Location', '/category/' . $category)->withStatus(302);
    }
}
