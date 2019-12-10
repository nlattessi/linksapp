<?php

declare(strict_types=1);

namespace App\Controllers\Categories;

use App\Entities\Category;
use App\Traits\RedirectTrait;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

class AddCategory
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
        $data = (array)$request->getParsedBody();

        if (!array_key_exists('name', $data)) {
            throw new RuntimeException("Validation failure");
        }

        $category = new Category();
        $category->setName($data['name']);
        $createdAt = new DateTime('now', new DateTimeZone('UTC'));
        $category->setCreatedAt($createdAt);
        $this->em->persist($category);
        $this->em->flush();

        return $this->redirectToHome($this->response);
    }
}
