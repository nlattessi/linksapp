<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Traits\TemplateEngineTrait;
use Doctrine\ORM\EntityManager;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Home
{
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
//        $queryParams = (array)$request->getQueryParams();

//        $selectedCategoryName = array_key_exists('category', $queryParams) ? $queryParams['category'] : null;

        $categories = $this->em->getRepository('App:Category')->findAllOrderByName();

//        $links = isset($selectedCategoryName)
//            ? $this->em->getRepository('App:Category')->findOneBy(['name' => $selectedCategoryName])->getLinks()
//            : $this->em->getRepository('App:Link')->findAll();

        $data = [
            'categories' => $categories,
//            'links' => $links,
//            'selectedCategoryName' => $selectedCategoryName,
        ];

        return $this->renderHtml(
            $this->response,
            $this->templateEngine,
            'base',
            $data
        );
    }
}
