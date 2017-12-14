<?php
//session_set_cookie_params (432000, '/~up201502860/FEUP-LTW', 'gnomo.fe.up.pt', true,  true);
function setCSRFToken() {
  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }
}

function setCurrentUser($username){
  $_SESSION['username'] = $username;
}

function checkValidSession(){
  if(!isset($_SESSION['username']))
    header('Location: index.php');
}

function generate_random_token() {
  return bin2hex(openssl_random_pseudo_bytes(32));
}

session_start();
setCSRFToken();

?>
