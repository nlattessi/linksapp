<?php

declare(strict_types=1);

namespace App\Controllers\Links;

use App\Entities\Link;
use App\Traits\RedirectTrait;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

class DeleteLink
{
    use RedirectTrait;

    private ResponseInterface $response;
    private EntityManager $em;

    public function __construct(
        ResponseInterface $response,
        EntityManager $em
    )
    {
        $this->response = $response;
        $this->em = $em;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Link $link */
        $link = $this->em->getRepository('App:Link')->find($request->getAttribute('id'));

        if (!$link) {
            throw new RuntimeException("No se encuentra el link");
        }

        $categoryName = $link->getCategory()->getName();

        $this->em->remove($link);
        $this->em->flush();

        return $this->redirectToCategory($this->response, $categoryName);
    }
}
