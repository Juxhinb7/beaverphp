<?php

namespace Beaver;

/**
 * @property-read ?array $db;
 */
final class Config 
{
    private array $config = [];

    private function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'host' => $env['DB_HOST'],
                'user' => $env['DB_USER'],
                'pass' => $env['DB_PASS'],
                'database' => $env['DB_DATABASE'],
                'driver' => $env['DB_DRIVER'] ?? 'mysql'
            ]
        ];
    }

    public static function make(array $env): Config
    {
        return new Config($env);
    }

    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }


}