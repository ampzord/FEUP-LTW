<?php
include_once('includes/init.php');

  function verifyPassword() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT passwordHash FROM User WHERE username = ?');
    $stmt->execute(array($_SESSION['username']));
    $pass = $stmt->fetch();
    return password_verify($_POST['password'], $pass['passwordHash']);
  }

  function changePassword($username, $newPassword) {
    global $dbh;
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $db->prepare('UPDATE User SET passwordHash = ? WHERE username = ?');
		$stmt->execute(array($username, $newPasswordHash));
  }

  
  function updateProfile() {

  }

  function getUserTeams(){
    global $dbh;
    $stmt = $dbh->prepare('SELECT Team.name FROM Team Join User ON Team.idUser == Team.id WHERE User.username = ?');
    $stmt->execute(array($_SESSION['username']));
    $teamsTable = $stmt->fetchAll();
    $_SESSION['teams'] = $teamsTable['name'];
  }

?>
