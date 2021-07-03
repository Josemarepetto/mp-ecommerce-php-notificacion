<?php

        $json= file_get_contents('php://input');
        $decoded = json_decode($json, true);

        if(isset($decoded['type'])){
            if($decoded['type']=="payment"){
              //Grabo en archivo
              file_put_contents('inputs.log','Id del Pago: '.$decoded['data']['id']. PHP_EOL, FILE_APPEND);
              $url = 'https://api.mercadopago.com/v1/payments/';
              $header = array('Authorization:Bearer APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

              $ch = curl_init();
              $getUrl = $url.$decoded['data']['id'];

              //echo $getUrl;
              curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              curl_setopt($ch, CURLOPT_URL, $getUrl);
              curl_setopt($ch, CURLOPT_TIMEOUT, 80);
              
              $response = curl_exec($ch);
              
              if(curl_error($ch)){
                echo 'Error al buscar el pago por Id: ' . curl_error($ch);
              }
              else
              {
                $jsonResponse = json_decode($response, true);
                //Grabo en archivo
                file_put_contents('inputs.log','Status del Pago: '.$jsonResponse['status']. PHP_EOL, FILE_APPEND);
                echo $jsonResponse['status'];
              }
              
              curl_close($ch);
            }
        }
?>
