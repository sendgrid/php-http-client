<?php
/** 
  * Environment Variable Configuration
  *
  * PHP version 5.2
  *
  * @author    Matt Bernier <dx@sendgrid.com>
  * @author    Elmer Thomas <dx@sendgrid.com>
  * @copyright 2016 SendGrid
  * @license   https://opensource.org/licenses/MIT The MIT License
  * @version   GIT: <git_id>
  * @link      http://packagist.org/packages/sendgrid/php-http-client
  */
namespace SendGrid;

/**
  * Sets environment variables.
  */
class Config
{
    /**
      * Setup the environment variables
      *
      * @param string $base_path       path to your config file.
      * @param string $config_filename name of the config file.
      */
    function __construct($base_path, $config_filename)
    {
        $handle = fopen($base_path.'/'.$config_filename, "r");
        while (($line = fgets($handle)) !== false) {
            putenv(trim(preg_replace('/\s+/', ' ', $line)));
        }
        fclose($handle);
    }
}
?>
