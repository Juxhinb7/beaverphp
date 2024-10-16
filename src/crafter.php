<?php

class Crafter{
    public function execute($args)
    {
        try {
            if (explode(":", $args[1])[0] === "make"){

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
        catch(\Exception $e)
        {
            echo "No arguments were given." . PHP_EOL;
        }
        
    }
}
(new Crafter())->execute($argv);