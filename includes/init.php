<?php
  include_once('includes/session.php');
  include_once('database/connection.php');

  function console_log($data){
  echo '<script>';
  echo 'console.log('. json_encode($data) .')';
  echo '</script>';
}
 ?>
