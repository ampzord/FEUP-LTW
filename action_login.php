<?php
include_once('includes/init.php');
include_once('database/users.php');

	global $purifier;
	global $dbh;
	
	$usernameClean = $purifier->purify($_POST['username']);

  $stmt = $dbh->prepare('SELECT * FROM User WHERE username = ?');
  $stmt->execute(array($usernameClean));
  $user = $stmt->fetch();

  if ($user !== false && password_verify($_POST["password"], $user['passwordHash'])){
    echo "Login Successful\n";
    setCurrentUser($user['username']);
    getUserTeams();
    //$_SESSION['loginError'] = "";
    $_SESSION['username'] = $usernameClean;
    //$_SESSION['fullname'] = $user['fullName'];
    header('Location: interface.php');
  }
  else {
    echo "Login Failed\n";
		session_destroy();
		session_set_cookie_params (432000, '/~up201504818/justdoit', 'www.gnomo.fe.up.pt', true,  true);
    session_start();
    //$_SESSION['loginError'] = "Mensagem de Error";
    header('Location: index.php');
  }
?>
