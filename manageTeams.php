<?php
include_once('includes/init.php');
checkValidSession();

global $dbh;
global $purifier;

$purifier->purify($_POST['teamName']);

//Creates a new Team and add's creator to said team
if (isset($_POST['teamName'])){
    $teamName = $_POST['teamName'];

    try {
        $stmt = $dbh->prepare("INSERT INTO Team(name) VALUES ?");
        $stmt->execute(array($teamName));
    }catch(PDOException $e){
      header('Location: teamManager.php?erro=duplicatedTeamName');
    }
    
    $stmt = $dbh->prepare("SELECT id FROM Team WHERE Team.name == ?");
    $stmt->execute(array($teamName));

    $teamID = $stmt['id'];

    $stmt = $dbh->prepare("INSERT INTO TeamMember(idUser, idTeam) VALUES(?, ?)");
    $stmt->execute(array($_SESSION['username'], $teamID));

}

  ?>