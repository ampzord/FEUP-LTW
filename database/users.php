<?php
include_once('includes/init.php');

  function verifyPassword() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT passwordHash FROM User WHERE username = ?');
    $stmt->execute(array($_SESSION['username']));
    $pass = $stmt->fetch();
    return password_verify($_POST['password'], $pass['passwordHash']);
  }

  function updatePassword($username, $newPassword) {
    global $dbh;
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $dbh->prepare('UPDATE User SET passwordHash = ? WHERE username = ?');
		$stmt->execute(array($username, $newPasswordHash));
  }

  function updateProfile($email, $country, $fullName, $username) {
		global $dbh;
		$stmt = $dbh->prepare('UPDATE User SET email = ?, country = ?, fullName = ?
    WHERE username == ?');
		$stmt->execute(array($email, $country, $fullName, $username));
	}

  function getUserFullName($username) {
		global $dbh;
		$stmt = $dbh->prepare('SELECT fullName FROM User WHERE username == ?');
		$stmt->execute(array($username));
		$fullName = $stmt->fetch();
		if (!$fullName)
			return false;
		return $fullName['fullname'];
	}

  function validFullName($fullName) {
		return (preg_match('/^\w{4,10}$/', $username) == 1);
	}

  function getUserInformation() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * from User WHERE username == ?');
    $stmt->execute(array($_SESSION['username']));
    return $stmt->fetch();
  }

  function getUserTeams(){
    global $dbh;
    $stmt = $dbh->prepare('SELECT Team.name FROM Team Join User ON Team.idUser == User.id WHERE User.username == ?');
    $stmt->execute(array($_SESSION['username']));
    $teamsTable = $stmt->fetchAll();

    $teamNames = array();
    foreach ($teamsTable as $val) {
      array_push($teamNames, $val['name']);
    }
    $_SESSION['teams'] = $teamNames;
    // var_dump($teamNames);
    // die;
  }

function getUserID(){
    global $dbh;
    $stmt = $dbh->prepare('SELECT id from User WHERE username == ?');
    $stmt->execute(array($_SESSION['username']));
    return $stmt->fetch()['id'];
  }

function createTeam($teamName){
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO Team(name, color, idUser) VALUES (?,?,?)');
    $stmt->execute(array($teamName, "#666", getUserID()));
    // return lastInsertId($stmt);
  }

?>
