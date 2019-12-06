<?php

declare(strict_types=1);

namespace App\Controllers\Links;

use App\Models\CategoryRepository;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;

class ShowFormAddLink
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

    public function __invoke(): ResponseInterface
    {
        $categories = $this->categoryRepository->getAll();

        $response = $this->response->withHeader('Content-Type', 'text/html');
        $response->getBody()->write(
            $this->templateEngine->render('agregar-link', [
                'categories' => $categories,
            ])
        );

        return $response;
    }
}
