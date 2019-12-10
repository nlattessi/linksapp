<?php

declare(strict_types=1);

namespace App\Controllers\Links;

use App\Entities\Category;
use App\Entities\Link;
use App\Traits\RedirectTrait;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

class AddLink
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
        /** @var Category $selectedCategory */
        $category = $this->em->getRepository('App:Category')->findOneBy([
            'name' => $request->getAttribute('name')
        ]);

        if (!$category) {
            throw new RuntimeException("No se encuentra la categoría");
        }

        $data = (array)$request->getParsedBody();

        if (!array_key_exists('url', $data)) {
            throw new RuntimeException("Falta url");
        }
        if (!filter_var($data['url'], FILTER_VALIDATE_URL)) {
            throw new RuntimeException("La url ingresada no es una url válida");
        }

        $link = new Link();
        $link->setUrl($data['url']);
        if (array_key_exists('title', $data)) {
            $link->setTitle($data['title']);
        }
        $link->assignCategory($category);
        $createdAt = new DateTime('now', new DateTimeZone('UTC'));
        $link->setCreatedAt($createdAt);
        $this->em->persist($link);
        $this->em->flush();

        return $this->redirectToCategory($this->response, $category->getName());
    }
}
