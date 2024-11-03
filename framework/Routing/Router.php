<?php

namespace Beaver\Routing;

use Beaver\Container;
use Beaver\Attributes\Routing\Route;
use Beaver\Exception\Routing\RouteNotFoundException;
use ReflectionClass;
use ReflectionAttribute;

final class Router
{
    private function __construct(private Container $container)
    {

    }
    private array $routes;

    public function registerRoutesFromAttr(array $controllers)
    {
        foreach ($controllers as $controller)
        {
            $reflectionController = new ReflectionClass($controller);
            
            foreach ($reflectionController->getMethods() as $method)
            {
                $attributes = $method->getAttributes(Route::class, ReflectionAttribute::IS_INSTANCEOF);

                foreach ($attributes as $attribute) 
                {
                    $route = $attribute->newInstance();

                    $id = explode('/', $_SERVER['REQUEST_URI'])[2] ?? "";
                    $concrete_path = str_replace('{id}', $id, $route->path);

                    $this->register($route->method, $concrete_path, [$controller, $method->getName()]);
                }
            }
        }
    }

    public function register(string $requestMethod, string $route, callable|array $action): self
    {   
        $this->routes[$requestMethod][$route] = $action;
        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register('get', $route, $action);
    }
    
    public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }

    public function routes()
    {
        return $this->routes;
    }

    public function resolve(string $requestUri, string $requestMethod)
    {
        $id = explode('/', $_SERVER['REQUEST_URI'])[2] ?? "";

        $route = explode('?', $requestUri)[0];
        

        $action = $this->routes[$requestMethod][$route] ?? null;


        if (!$action)
        {
            throw new RouteNotFoundException();
        } 

        if (is_callable($action)) {
            return call_user_func($action, $id);
        }


        [$class, $method] = $action;

        if (class_exists($class)) {
            $class = $this->container->get($class);

            if (method_exists($class, $method)) {

                return call_user_func_array([$class, $method], [$id ]);
            }
        }
    }

    public static function make(Container $container): Router
    {
        return new Router($container);
    }

    
}