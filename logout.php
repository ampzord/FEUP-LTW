<?
  session_destroy();
  unset($_SESSION);
  session_start();
  header('Location: index.php');
?>
