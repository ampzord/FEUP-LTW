<?php
include_once('includes/init.php');

  global $dbh;
  $stmt = $dbh->prepare('SELECT * FROM User WHERE username = ?');
  $stmt->execute(array($_POST['username']));

  if($stmt->fetch()){
    echo 'Username ' . $_POST['username'] . ' already exists';
    die();
  }
  if($_POST['password'] != $_POST['passwordVerify']){
    echo 'The passwords didn\'t match';
    die();
  }

  $passHash = password_hash ( $_POST['password'], PASSWORD_DEFAULT, []);
    // echo "Password" . $_POST['password'] . " - Hash " . $passHash . " def: " . PASSWORD_DEFAULT;

// Insert na tabela
  $stmt = $dbh->prepare('INSERT INTO User(username, email, country, passwordHash) VALUES (?, ?, ?, ?)');
  $stmt->execute(array($_POST['username'], $_POST['email'], $_POST['country'], $passHash));
?>
