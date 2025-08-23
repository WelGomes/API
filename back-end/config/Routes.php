<?php

final class Routes
{

    private string $uri;
    private string $request;

    public function __construct(
        string $uri,
        string $request
    ) {
        $this->uri = $uri;
        $this->request = $request;
    }

    private function load(
        string $controller,
        string $method
    ): mixed {
        $classController = "\\Project\\controller\\{$controller}";

        if (!class_exists($classController)) {
            throw new Exception('Diretorio não existe!' . $classController);
        }

        $class = new $classController();

        if (!method_exists($class, $method)) {
            throw new Exception('Metodo no diretorio não existe!');
        }

        return $class->$method();
    }

    public function routes(): mixed
    {
        $routes = [
            'POST' => [
                '/user' => fn() => $this->load(controller: 'UserController', method: 'post'),
            ],
            'GET' => [
                '/user' => fn() => $this->load(controller: 'UserController', method: 'get'),
            ],
            'PUT' => [
                '/user' => fn() => $this->load(controller: 'UserController', method: 'get'),
            ],
            'DELETE' => [
                '/user' => fn() => $this->load(controller: 'UserController', method: 'get'),
            ]
        ];

        if (!array_key_exists($this->request, $routes)) {
            throw new Exception('Requisição não existe');
        }

        if (!array_key_exists($this->uri, $routes[$this->request])) {
            throw new Exception('Path não existe ' . $this->uri);
        }

        return $routes[$this->request][$this->uri]();
    }
}
