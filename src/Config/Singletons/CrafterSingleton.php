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
        file_put_contents($fileName, '
<?php

class Crafter{
    public function execute($args)
    {
        if (explode(":", $args[1])[0] === "make"){
            if (explode(":", $args[1])[1] === "controller")
            {
                if (!is_dir("controllers")) {
                    mkdir("controllers");
                }
                
                file_put_contents("controllers/" . $args[2], "Hello from controller");
            }

            $fileType = explode(":", $args[1])[1];

            match($fileType) {
                "controller" => (function() use($args){
                    if (!is_dir("controllers")) {
                        mkdir("controllers");
                    }

                    if ($args[2]) {
                        file_put_contents("controllers/" . $args[2] . ".php", sprintf("
<?php

class %s
{

}
                        ", $args[2]));
                    }
                })(),
                default => (function(){
                    echo "Cannot process file type." . PHP_EOL;
                })()
            };
        }
    }
}
(new Crafter())->execute($argv);');
    }

}