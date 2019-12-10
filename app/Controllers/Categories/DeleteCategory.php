<?php

declare(strict_types=1);

namespace App\Controllers\Categories;

use App\Entities\Category;
use App\Traits\RedirectTrait;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

class DeleteCategory
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
        /** @var Category $category */
        $category = $this->em->getRepository('App:Category')->find($request->getAttribute('id'));

        if (!$category) {
            throw new RuntimeException("No se encuentra la categoría");
        }

        $this->em->remove($category);
        $this->em->flush();

        return $this->redirectToHome($this->response);
    }
}
