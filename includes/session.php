<?php
session_start();

function setCurrentUser($username){
  $_SESSION['username'] = $username;
}

function checkValidSession(){
  if(!isset($_SESSION['username']))
    header('Location: index.php');
}
?>
