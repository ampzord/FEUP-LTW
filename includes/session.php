<?php
session_start();

function setCurrentUser($username){
  $_SESSION['username'] = $username;
}

function checkValidSession(){
  if(!isset($_SERVER['username']))
    header('Location: index.php');
}
?>
