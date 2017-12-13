<?php
  include_once('includes/session.php');
  include_once('database/connection.php');
  require_once 'library/HTMLPurifier.auto.php';
  $config = HTMLPurifier_Config::createDefault();
  $purifier = new HTMLPurifier($config); //Access in other function, "global $purifier"  
 ?>