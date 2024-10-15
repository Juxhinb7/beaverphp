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
        file_put_contents($fileName, "<?php\n\n" . 'class Crafter{public function execute($args){if (explode(":", $args[1])[0] === "make"){echo "made";}}}(new Crafter())->execute($argv);');
    }

}