<?php

declare(strict_types=1);

namespace App\Traits;

use Psr\Http\Message\ResponseInterface;

trait RedirectTrait
{
    protected function redirectToHome(ResponseInterface $response)
    {
        return $response->withHeader('Location', '/')->withStatus(302);
    }
}
