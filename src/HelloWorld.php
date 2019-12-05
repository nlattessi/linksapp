<?php

declare(strict_types=1);

namespace App;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class HelloWorld
{
    private $foo;

    private $response;

    private $templateEngine;

    public function __construct(
        string $foo,
        ResponseInterface $response,
        Engine $templateEngine
    ) {
        $this->foo = $foo;
        $this->response = $response;
        $this->templateEngine = $templateEngine;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        var_dump($request->getUploadedFiles());die;
        $response = $this->response->withHeader('Content-Type', 'text/html');        
        $response->getBody()->write(
            $this->templateEngine->render('hello-world', [
                'title' => 'xxx',
                'name' => 'yyy',
            ])
        );

        return $response;
    }
}
