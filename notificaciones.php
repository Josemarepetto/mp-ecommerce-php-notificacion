<?php

    class webhook{

      public function __construct(){
        $json= file_get_contents('php://input');
        $decoded = json_decode($json, true);

        //Salvo el Body del Json
        ob_start();
        var_dump($decoded);
        $input = ob_get_contents();
        ob_end_clean();

        if(isset($decoded['type'])){
            if($decoded['type']=="payment"){
                echo $decoded;
                //Grabo en archivo
                file_put_contents('inputs.log',$date_created . PHP_EOL, FILE_APPEND);
            }
        }
        
      }
    }
    new webhook();
?>
