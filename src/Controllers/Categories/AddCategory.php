<?php

declare(strict_types=1);

namespace App\Controllers\Categories;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\CategoryRepository;
use App\Traits\RedirectTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

class AddCategory
{
    use RedirectTrait;

    /** @var ResponseInterface */
    private $response;

    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(
        ResponseInterface $response,
        CategoryRepository $categoryRepository
    )
    {
        $this->response = $response;
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

        return $this->redirectToHome($this->response);
    }
}
