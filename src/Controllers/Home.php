<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\CategoryRepository;
use App\Models\LinkRepository;
use App\Traits\TemplateEngineTrait;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Home
{
    use TemplateEngineTrait;

    /** @var ResponseInterface */
    private $response;

    /** @var Engine */
    private $templateEngine;

    /** @var CategoryRepository */
    private $categoryRepository;

    /** @var LinkRepository */
    private $linkRepository;

    public function __construct(
        ResponseInterface $response,
        Engine $templateEngine,
        CategoryRepository $categoryRepository,
        LinkRepository $linkRepository
    )
    {
        $this->response = $response;
        $this->templateEngine = $templateEngine;
        $this->categoryRepository = $categoryRepository;
        $this->linkRepository = $linkRepository;
    }


    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = (array)$request->getQueryParams();

        $selectedCategoryName = array_key_exists('category', $queryParams) ? $queryParams['category'] : null;

        $categories = $this->categoryRepository->getAll();

        $links = isset($selectedCategoryName) ?
            $this->linkRepository->getAllWhereCategoryNameIs($selectedCategoryName) :
            $this->linkRepository->getAll();

        $data = [
            'categories' => $categories,
            'links' => $links,
            'selectedCategoryName' => $selectedCategoryName,
        ];

        return $this->renderHtml(
            $this->response,
            $this->templateEngine,
            'home',
            $data
        );
    }
}
