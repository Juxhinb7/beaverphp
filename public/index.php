<?php
 
require_once __DIR__ . '/../vendor/autoload.php';

use Beaver\Routing\Router;
use App\Http\Controllers\HomeController;

$router = Router::make();   

const SMARTY_CONFIG = [
    'views' => __DIR__ . '/../resources/views',
    'compile' => __DIR__ . '/../resources/compile',
    'configs' => __DIR__ . '/../resources/configs',
    'cache' => __DIR__ . '/../resources/cache'
];

$router
    ->get('/', [HomeController::class, 'index']);


echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));