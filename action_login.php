<?php
include_once('includes/init.php');
include_once('database/users.php');

if ($_SESSION['csrf'] !== $_POST['csrf']) {
  header('Location: index.php');
  die;
}

	global $purifier;
	global $dbh;
	
  $_POST['username'] = $purifier->purify($_POST['username']);
  $_POST["password"] = $purifier->purify($_POST["password"]);

  $stmt = $dbh->prepare('SELECT * FROM User WHERE username = ?');
  $stmt->execute(array($_POST['username']));
  $user = $stmt->fetch();

  if ($user !== false && password_verify($_POST["password"], $user['passwordHash'])){
    echo "Login Successful\n";
    setCurrentUser($user['username']);
    getUserTeams();
    $_SESSION['username'] = $_POST['username'];
    header('Location: interface.php');
  }
  else {
    header('Location: index.php?erro=loginInvalid');
  }
?>
