<?php
include_once('includes/init.php');
include_once('database/users.php');

	global $purifier;
	global $dbh;
	
	$purifier->purify($_POST['username']);

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
    header('Location: index.php?erro=loginInvalid');
  }
?>
