<?php
include_once('includes/init.php');
include_once('database/users.php');

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
    setCurrentUser($user['username']);
    getUserTeams();
    //$_SESSION['loginError'] = "";
    $_SESSION['username'] = $_POST['username'];
    //$_SESSION['fullname'] = $user['fullName'];
    header('Location: interface.php');
  }
  else {
    echo "Login Failed\n";
    session_destroy();
    session_start();
    //$_SESSION['loginError'] = "Mensagem de Error";
    header('Location: index.php');
  }
?>
