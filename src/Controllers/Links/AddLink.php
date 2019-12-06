<?php

declare(strict_types=1);

namespace App\Controllers\Links;

use App\Models\Link;
use App\Models\LinkRepository;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

class AddLink
{
    /** @var ResponseInterface */
    private $response;

    /** @var Engine */
    private $templateEngine;

    /** @var LinkRepository */
    private $linkRepository;

    public function __construct(
        ResponseInterface $response,
        Engine $templateEngine,
        LinkRepository $linkRepository
    )
    {
        $this->response = $response;
        $this->templateEngine = $templateEngine;
        $this->linkRepository = $linkRepository;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $data = (array)$request->getParsedBody();

        try {
            $link = Link::newLink($data);
        } catch (RuntimeException $e) {
            // TODO
            // Hacer algo
        }

        $this->linkRepository->add($link);

        return $this->response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }
}
