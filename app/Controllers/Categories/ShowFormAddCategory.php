<?php

declare(strict_types=1);

namespace App\Controllers\Categories;

use App\Traits\TemplateEngineTrait;
use Doctrine\ORM\EntityManager;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ShowFormAddCategory
{
    use TemplateEngineTrait;

    private ResponseInterface $response;
    private Engine $templateEngine;
    /**
     * @var EntityManager
     */
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
        $data = [
            'categories' => $this->em->getRepository('App:Category')->findAllOrderByName(),
        ];

        return $this->renderHtml(
            $this->response,
            $this->templateEngine,
            'add-category',
            $data
        );
    }
}
