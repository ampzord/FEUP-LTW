<?
  // include_once('')
  /*session_destroy();
  unset($_SESSION['username']);
  session_start();*/

  session_set_cookie_params (432000, '/~up201307910/justdoit', 'gnomo.fe.up.pt', true, true);  
  session_start();
  session_destroy();
  unset($_SESSION);

  header('Location: index.php');
?>
