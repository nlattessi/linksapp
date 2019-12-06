<?php

declare(strict_types=1);

namespace App\Controllers\Categories;

use App\Models\CategoryRepository;
use App\Traits\TemplateEngineTrait;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ShowFormAddCategory
{
    use TemplateEngineTrait;

    /** @var ResponseInterface */
    private $response;

    /** @var Engine */
    private $templateEngine;

    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(
        ResponseInterface $response,
        Engine $templateEngine,
        CategoryRepository $categoryRepository
    )
    {
        $this->response = $response;
        $this->templateEngine = $templateEngine;
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        return $this->renderHtml(
            $this->response,
            $this->templateEngine,
            'add-category'
        );
    }
}
