<?php
include_once('init.php');

  function verifyPassword() {
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
?>
