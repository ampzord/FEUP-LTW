<?
  //session_set_cookie_params (432000, '/~up201502860/FEUP-LTW', 'gnomo.fe.up.pt', true,  true);
  session_start();
  session_destroy();
  unset($_SESSION);

  header('Location: index.php');
?>
