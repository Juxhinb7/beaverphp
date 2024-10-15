<?php

namespace Beaver\Config\Singletons;

final class CrafterSingleton
{
    private static $instance;
    private function __construct()
    {

    }

    public static function makeSingle(): CrafterSingleton
    {
        if (!isset(CrafterSingleton::$instance)) {
            CrafterSingleton::$instance =  new CrafterSingleton();
        }
        return CrafterSingleton::$instance;
    }

    public function generateFile($fileName = 'crafter'): void
    {
        file_put_contents($fileName, "<?php\n" . '
        class Crafter{
            public function execute($args)
            {
                if (explode(":", $args[1])[0] === "make"){
                    if (explode(":", $args[1])[1] === "controller")
                    {
                        mkdir("controllers");
                        file_put_contents("controllers/" . $args[2], "Hello from controller");
                    }
                }
            }
        }
        (new Crafter())->execute($argv);');
    }

}