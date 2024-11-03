<?php

namespace Beaver\Exception\Routing;

class RouteNotFoundException extends \Exception
{
    protected $message = "Route not found.";
}