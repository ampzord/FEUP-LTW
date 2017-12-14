<?php
include_once('includes/init.php');

  function verifyPassword() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT passwordHash FROM User WHERE username = ?');
    $stmt->execute(array($_SESSION['username']));
    $pass = $stmt->fetch();
    return password_verify($_POST['password'], $pass['passwordHash']);
  }

  function getUserPassword($username) {
     global $dbh;
     $stmt = $dbh->prepare('SELECT passwordHash FROM User WHERE username = ?');
     $stmt->execute(array($username));
     $pass = $stmt->fetch();
     if (!$pass)
         return false;
     return $pass['passwordHash'];
 }

  function updatePassword($username, $newPassword) {
    global $dbh;
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $dbh->prepare('UPDATE User SET passwordHash = ? WHERE username = ?');
		$stmt->execute(array($newPasswordHash, $username));
  }

  function updateProfile($email, $country, $fullName, $phoneNumber, $birthDate, $username) {
		global $dbh;
		$stmt = $dbh->prepare('UPDATE User SET email = ?, country = ?, fullName = ?, phoneNumber = ?, birthDate = ?
    WHERE username == ?');
		$stmt->execute(array($email, $country, $fullName, $phoneNumber, $birthDate, $username));
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

  function getUserEmail($username) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT email FROM User WHERE username == ?');
    $stmt->execute(array($username));
    $email = $stmt->fetch();
    if (!$email)
      return false;
    return $email['email'];
  }

  function getUserBirthDate($username) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT birthDate FROM User WHERE username == ?');
    $stmt->execute(array($username));
    $birthDate = $stmt->fetch();
    if (!$birthDate)
      return false;
    return $birthDate['$birth-date'];
  }

  function getUserPhoneNumber($username) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT phoneNumber FROM User WHERE username == ?');
    $stmt->execute(array($username));
    $phoneNumber = $stmt->fetch();
    if (!$phoneNumber)
      return false;
    return $phoneNumber['$phone-number'];
  }

  function getUserCountry($username) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT country FROM User WHERE username == ?');
    $stmt->execute(array($username));
    $country = $stmt->fetch();
    if (!$country)
      return false;
    return $country['$country'];
  }

  function getUserInformation() {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * from User WHERE username == ?');
    $stmt->execute(array($_SESSION['username']));
    return $stmt->fetch();
  }

  function getUserTeams(){
    global $dbh;
    /*$stmt = $dbh->prepare('SELECT Team.name FROM Team Join User ON Team.idUser == User.id WHERE User.username == ?');*/
    $stmt = $dbh->prepare('SELECT Team.name 
    FROM Team JOIN TeamMember ON TeamMember.idTeam == Team.id
    Join User ON TeamMember.idUser == User.id
    WHERE User.username == ? AND TeamMember.accepted == 1');
    $stmt->execute(array($_SESSION['username']));
    
    $teamsTable = $stmt->fetchAll();

    $teamNames = array();
    foreach ($teamsTable as $val) {
      array_push($teamNames, $val['name']);
    }
    $_SESSION['teams'] = $teamNames;
  }

function getUserID(){
    global $dbh;
    $stmt = $dbh->prepare('SELECT id from User WHERE username == ?');
    $stmt->execute(array($_SESSION['username']));
    return $stmt->fetch()['id'];
  }

function createTeam($teamName){
    global $dbh;
    $stmt = $dbh->prepare('INSERT INTO Team(name) VALUES (?)');
    $stmt->execute(array($teamName));
    $teamID = $dbh->lastInsertId();

    
    $stmt = $dbh->prepare("INSERT INTO TeamMember(idUser, idTeam, accepted) VALUES(?, ?, 1)");
    $stmt->execute(array(getUserID(), $teamID)); 
    // return lastInsertId($stmt);
  }

  function validPhoneNumber($phoneNumber) {
    return preg_match('/^(\+\d{1,3})?\d{9}$/', $phoneNumber);
  }

  function validUsername($username) {
    return preg_match('/^[a-zA-Z][0-9a-zA-Z]{2,14}$/', $username);
  }

  function validFullName($fullName) {
    return preg_match('/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.\'-]*[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð,.\'-]$/', $fullName);
  }

?>
