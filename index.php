<?php 
  $data = file_get_contents('php://input');
  file_put_contents('./inputs.log', $data . PHP_EOL, FILE_APPEND);
  echo $data;
?>
