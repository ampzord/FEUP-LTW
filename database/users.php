<?php
  include_once('includes/init.php');

  function getUserPassword($username) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT passwordHash FROM User WHERE username = ?;');
        $stmt->execute(array($username));
        $pass = $stmt->fetch();
        if (!$pass)
            return false;
        return $pass['password'];
    }

  function updatePassword($username, $newPassword) {
    global $dbh;
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $dbh->prepare('UPDATE User SET passwordHash = ? WHERE username = ?');
		$stmt->execute(array($username, $newPasswordHash));
  }

  function updateProfile($email, $country, $fullName, $birthDate, $username) {
		global $dbh;
		$stmt = $dbh->prepare('UPDATE User SET email = ?, country = ?, fullName = ?, birthDate = ?
     WHERE username = ?;');
		$stmt->execute(array($email, $country, $fullName, $birthDate, $username));
	}

  function getUserFullName($username) {
		global $dbh;
		$stmt = $dbh->prepare('SELECT fullName FROM User WHERE username = ?');
		$stmt->execute(array($username));
		$fullName = $stmt->fetch();
		if (!$fullName)
			return false;
		return $fullName['fullname'];
	}

  function validFullName($fullName) {
    //return (preg_match(           , $u
		return (preg_match('/^\w{4,10}$/', $username) === 1);
	}

?>
