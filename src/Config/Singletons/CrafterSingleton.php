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
        file_put_contents($fileName . '.php', '<?php

class Crafter{
    public function execute($args)
    {
        if (explode(":", $args[1])[0] === "make"){

            $fileType = explode(":", $args[1])[1];

            match($fileType) {
                "controller" => (function() use($args){
                    if (!is_dir("Application/Controllers")) {
                        mkdir("Application/Controllers", 0777, true);
                    }
                    

                    if ($args[2]) {
                        file_put_contents("Application/Controllers/" . $args[2] . ".php", sprintf("<?php\n\n namespace Application\Controllers;\n\nclass %s \n{\n\n}", $args[2]));
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