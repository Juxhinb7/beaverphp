<?php

namespace Beaver;

use Beaver\Exception\Container\ContainerException;
use Psr\Container\ContainerInterface;
use ReflectionUnionType;
use ReflectionNamedType;
use ReflectionParameter;

final class Container implements ContainerInterface
{
    private array $entries = [];

    private function __construct(protected bool $autoWiring)
    {

    }
    
    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];
            return $entry($this);
        }

        if ($this->autoWiring)
        {
            return $this->resolve($id);
        }
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    private function resolve($id){
        $reflectionClass = new \ReflectionClass($id);

        if (!$reflectionClass->isInstantiable()) 
        {
            throw new ContainerException('Instantiable class ' . $id . ' not found');
        }

        $constructor = $reflectionClass->getConstructor();

        if (!$constructor || !$constructor->getParameters()) 
        {
            return new $id;
        }

        $dependencies = array_map(function (ReflectionParameter $param) use($id) {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type) {
                throw new ContainerException(
                    'Failed to resolve class ' . $id . ' because param' . $name . ' is missing a type hint'
                );
            }

            if ($type instanceof ReflectionUnionType) {
                throw new ContainerException(
                    'Failed to resolve class ' . $id . ' because of union type hint'
                );
            }       

            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                return $this->get($type->getName());
            }

            throw new ContainerException(
                'Failed to resolve class ' . $id . ' because of invalid param'
            );


        }, $constructor->getParameters());

        return $reflectionClass->newInstanceArgs($dependencies);




    }

    public static function make(bool $autoWiring=false)
    {
        return new Container($autoWiring);
    }
}