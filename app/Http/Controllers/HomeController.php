<?php

namespace App\Http\Controllers;

use Beaver\Utilities\View;

class HomeController
{
    public function index()
    {
        (View::make('home/index', ['webFramework' => 'BeaverPHP', 'templateEngine' => 'Smarty']))->render();
    }
}