<?php
include_once('includes/init.php');
include_once('database/users.php');


  global $dbh;
  $stmt = $dbh->prepare('SELECT * FROM User WHERE username = ?');
  $stmt->execute(array($_POST['username']));

  if (!validUsername($_POST['username'])) {
    header('Location: interface.php');
    die();
  }

  if($stmt->fetch()){
    echo 'Username ' . $_POST['username'] . ' already exists';
  }
  /*var_dump($_POST['password']);
  var_dump($_POST['passwordVerify']);
  die;*/
  if($_POST['password'] !== $_POST['passwordVerify']){
    echo 'The passwords didn\'t match';
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
