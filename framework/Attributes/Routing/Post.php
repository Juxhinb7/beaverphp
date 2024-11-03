<?php

namespace Beaver\Attributes\Routing;

use Attribute;
use Beaver\Attributes\Routing\Route;

#[Attribute(Attribute::TARGET_METHOD)]
class Post extends Route
{
    public function __construct(string $path)
    {
        parent::__construct($path, 'post');
    }
}