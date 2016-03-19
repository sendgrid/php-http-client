<?php
class Config{
  function __construct($base_path, $config_filename){
    $handle = fopen($base_path.'/'.$config_filename, "r");
    while (($line = fgets($handle)) !== false) {
        putenv(trim(preg_replace('/\s+/', ' ', $line)));
    }
    fclose($handle);
  }
}
?>
