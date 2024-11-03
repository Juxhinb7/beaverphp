<?php

namespace Beaver;

use Beaver\Container;
use Beaver\Routing\Router;
use Beaver\Exception\Routing\RouteNotFoundException;
use Beaver\DB;
use Beaver\Config;

final class RouterApp
{
    private static DB $db;

    private function __construct(private Container $container, private Router $router, private array $request, private Config $config)
    {
        RouterApp::$db = DB::make($config->db ?? []);

    }

    public function register(callable $callback): RouterApp
    {
        $callback($this->container);
        return $this;
    }

    public static function db(): DB
    {
        return RouterApp::$db;
    }

    public function run()
    {
        try {
            $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
        } catch (RouteNotFoundException $e)
        {
            echo 'Server responded with following message: ' . $e->getMessage();
        }
    }

    public static function make(Container $container, Router $router, array $request, Config $config): RouterApp
    {
        return new RouterApp($container, $router, $request, $config);   
    }


}