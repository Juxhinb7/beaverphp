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

            $obj = explode(":", $args[1])[1];

            switch($obj)
            {
                case "controller":
                    (function() use($args){
                        if (!is_dir("controllers")) {
                            mkdir("controllers");
                        }    
                        file_put_contents("controllers/" . $args[2], sprintf("
class %s
{
    
}
                        ", $args[2]));
                    })();
                    break;
            }
        }
    }
}
(new Crafter())->execute($argv);');
    }

}