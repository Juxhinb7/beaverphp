<?php

namespace App\Http\Controllers;

use App\Services\InvoiceService;
use Beaver\Attributes\Routing\Get;
use Beaver\Utility\View;

class HomeController
{
    public function __construct(
        protected InvoiceService $invoiceService)
    {

    }
    #[Get('/hello/{id}')]
    public function index(string $id)
    {
        echo 'param id ' . $id; 
        
        (View::make('home/index', ['webFramework' => 'BeaverPHP', 'templateEngine' => 'Smarty']))->render();
    }
}