<?php
 
require_once __DIR__ . '/../vendor/autoload.php';

echo dirname(__DIR__);

use App\Services\InvoiceService;
use Beaver\Routing\Router;
use Beaver\RouterApp;
use App\Http\Controllers\HomeController;
use Dotenv\Dotenv;
use Beaver\Config;
use Beaver\Container;


/**
 * Loads the dotenv configuration environment.
 * @var mixed $dotenv
 */
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


/**
* Summary of SMARTY_CONFIG
* Configures the path for the resources that the Smarty Template Engine needs as a global array
* @var array    
*/
const SMARTY_CONFIG = [
    'views' => __DIR__ . '/../resources/views',
    'compile' => __DIR__ . '/../resources/compile',
    'configs' => __DIR__ . '/../resources/configs',
    'cache' => __DIR__ . '/../resources/cache'
];


/**
 * It initializes the dependency injection container with autoWiring defaulting to false
 * , but you can set it to true e.g. Container::make(autoWiring: true);
 * For interface injections you still have to bind manually no matter if autoWiring is set to true or false
 * @var Container $container
 */
$container = Container::make();


/**
 * It initializes the router with the container instance as argument
 * @var Router $router
 * @param Container $container
 */
$router = Router::make($container);   


/**
 * It registers the routes from controller method attributes
 */
$router->registerRoutesFromAttr([
    HomeController::class
]);


/**
 * It initializes the router application along with the appropriate arguments such as container, router, config array instances
 * and registers class id's to the their corresponding concrete instances for dependency injection
 */
(RouterApp::make(
    $container,
    $router, 
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    Config::make($_ENV)
))->register(function(Container $c) {
    /**
     * Here you can register your classes or interfaces for the container
     */
    $c->set(HomeController::class, function(Container $c) {
        return new HomeController(
            $c->get(InvoiceService::class)
        );
    });

    $c->set(InvoiceService::class, fn() => new InvoiceService());
    
})->run();  