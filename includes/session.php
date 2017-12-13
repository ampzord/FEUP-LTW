<?php
session_set_cookie_params (432000, '/~up201504818/justdoit', 'www.gnomo.fe.up.pt', true,  true);
session_start();

function setCurrentUser($username){
  $_SESSION['username'] = $username;
}

function checkValidSession(){
  if(!isset($_SESSION['username']))
    header('Location: index.php');
}
?>
