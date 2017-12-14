<?
<<<<<<< HEAD
  session_set_cookie_params (432000, '/~up201307910/justdoit', 'gnomo.fe.up.pt', true, true);  
=======
  // include_once('')
  /*session_destroy();
  unset($_SESSION['username']);
  session_start();*/

  //session_set_cookie_params (432000, '/~up201502860/FEUP-LTW', 'gnomo.fe.up.pt', true,  true);
>>>>>>> c8b4d0ae20b8a6ffe65286b448af86729137670d
  session_start();
  session_destroy();
  unset($_SESSION);

  header('Location: index.php');
?>
