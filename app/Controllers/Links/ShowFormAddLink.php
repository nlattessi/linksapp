<?php

declare(strict_types=1);

namespace App\Controllers\Links;

use App\Entities\Category;
use App\Traits\RedirectTrait;
use App\Traits\TemplateEngineTrait;
use Doctrine\ORM\EntityManager;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ShowFormAddLink
{
    use RedirectTrait;
    use TemplateEngineTrait;

    private ResponseInterface $response;
    private Engine $templateEngine;
    private EntityManager $em;

    public function __construct(
        ResponseInterface $response,
        Engine $templateEngine,
        EntityManager $em
    )
    {
        $this->response = $response;
        $this->templateEngine = $templateEngine;
        $this->em = $em;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Category $selectedCategory */
        $selectedCategory = $this->em->getRepository('App:Category')->findOneBy([
            'name' => $request->getAttribute('name')
        ]);

        if (!$selectedCategory) {
            return $this->redirectToHome($this->response);
        }

        $data = [
            'category' => $selectedCategory,
            'categories' => $this->em->getRepository('App:Category')->findAllOrderByName(),
            'selectedCategory' => $selectedCategory,
        ];

        return $this->renderHtml(
            $this->response,
            $this->templateEngine,
            'add-link',
            $data
        );
    }
}
