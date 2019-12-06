<?php

declare(strict_types=1);

namespace App\Controllers\Links;

use App\Controllers\BaseController;
use App\Models\Link;
use App\Models\LinkRepository;
use App\Traits\RedirectTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

class AddLink
{
    use RedirectTrait;

    /** @var ResponseInterface */
    private $response;

    /** @var LinkRepository */
    private $linkRepository;

    public function __construct(
        ResponseInterface $response,
        LinkRepository $linkRepository
    )
    {
        $this->response = $response;
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

        return $this->redirectToHome($this->response);
    }
}
