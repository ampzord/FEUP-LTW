<?
  // include_once('')
  /*session_destroy();
  unset($_SESSION['username']);
  session_start();*/

  session_start();
  session_destroy();
  unset($_SESSION);

  header('Location: index.php');
?>
