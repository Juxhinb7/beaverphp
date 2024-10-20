<?php

namespace Beaver\Exceptions;

class RouteNotFoundException extends \Exception
{
    protected $message = "Route not found.";
}