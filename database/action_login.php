<?php
include_once(__DIR__ . "/connection.php");


  // $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
  //   $stmt->execute(array($username));
  //   $user = $stmt->fetch();
  //   if ($user !== false && password_verify($password, $user['password'], )) {
  //     $_SESSION['username'] = $username;

  global $dbh;
  $stmt = $dbh->prepare('SELECT * FROM User WHERE username = ?');
  $stmt->execute(array($_POST['username']));
  $user = $stmt->fetch();

  if ($user !== false && password_verify($_POST["password"], $user['passwordHash'])){
    echo "Login Successful\n";
    //echo $_SERVER['HTTP_REFERER'];
    header('Location: ' . $_SERVER['HTTP_REFERER'] . 'interface.php');
  }
  else {
    echo "Login Failed\n";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }


?>
