<?php
include_once('includes/init.php');
include_once('database/users.php');


  global $dbh;
  $stmt = $dbh->prepare('SELECT * FROM User WHERE username = ?');
  $stmt->execute(array($_POST['username']));

  if (!validUsername($_POST['username'])) {
    header('Location: register.php?erro=invalidUsername');
    die;
  }

  if($stmt->fetch()){
    header('Location: register.php?erro=usernameExists');
    die;
    
  }
  if($_POST['password'] !== $_POST['passwordVerify']){
    header('Location: register.php?erro=password');
    die;
  }
  if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email'])){
    header('Location: register.php?erro=invalidEmail');
    die;
}

  $passHash = password_hash ( $_POST['password'], PASSWORD_DEFAULT, []);
  // echo "Password" . $_POST['password'] . " - Hash " . $passHash . " def: " . PASSWORD_DEFAULT;

  // Insert na tabela
  $stmt = $dbh->prepare('INSERT INTO User(username, email, country, passwordHash) VALUES (?, ?, ?, ?)');
  $stmt->execute(array($_POST['username'], $_POST['email'], $_POST['country'], $passHash));

  setCurrentUser($_POST['username']);

  createTeam($_SESSION['username'] . '\'s Team');
  getUserTeams();

  header('Location: interface.php');
?>
