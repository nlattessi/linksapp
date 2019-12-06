<?php

declare(strict_types=1);

namespace App\Controllers\Categories;

use App\Models\Category;
use App\Models\CategoryRepository;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

class AddCategory
{
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
        $data = (array)$request->getParsedBody();

        try {
            $category = Category::newCategory($data);
        } catch (RuntimeException $e) {
            // TODO
            // Hacer algo
        }

        $this->categoryRepository->add($category);

        return $this->response
            ->withHeader('Location', '/')
            ->withStatus(302);
    }
}
