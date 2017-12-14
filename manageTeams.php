<?php
include_once('includes/init.php');
checkValidSession();

global $dbh;
global $purifier;

if(isset($_POST['selectedTeam']) && isset($_POST['userInvite'])){
    $_POST['selectedTeam'] = $purifier->purify($_POST['selectedTeam']);
    $_POST['userInvite'] = $purifier->purify($_POST['userInvite']);




    
    if(in_array($_POST['selectedTeam'], $_SESSION['teams'])){
        $stmt = $dbh->prepare("SELECT id FROM Team WHERE Team.name == ?");
        $stmt->execute(array($_POST['selectedTeam']));
        $teamID = $stmt->fetch()['id'];    
        

        $stmt = $dbh->prepare("SELECT id FROM User WHERE User.username == ?");
        $stmt->execute(array($_POST['userInvite']));
        $usrID = $stmt->fetch()['id'];

        if($usrID == null){
            header('Location: teamManager.php?erro=inexistingUser');
            die;
        }

        $stmt = $dbh->prepare("INSERT INTO TeamMember(idUser, idTeam, accepted) VALUES(?, ?, 0)");
        $stmt->execute(array($usrID, $teamID));   

        header('Location: teamManager.php?success=2');
        die;
    }
    else{
        header('Location: teamManager.php?erro=invalidTeam');
        die;
    }
}
//Creates a new Team and add's creator to said team
else if (isset($_POST['teamName'])){
    $_POST['teamName'] = $purifier->purify($_POST['teamName']);
    $teamName = $_POST['teamName'];

    try {
        $stmt = $dbh->prepare("INSERT INTO Team(name) VALUES(?)");
        $stmt->execute(array($teamName));
    }catch(PDOException $e){
      header('Location: teamManager.php?erro=duplicatedTeamName');
      die;
    }
    
    $stmt = $dbh->prepare("SELECT id FROM Team WHERE Team.name == ?");
    $stmt->execute(array($teamName));
    $teamID = $stmt->fetch()['id'];

    $stmt = $dbh->prepare("SELECT id FROM User WHERE User.username == ?");
    $stmt->execute(array($_SESSION['username']));
    $usrID = $stmt->fetch()['id'];

    $stmt = $dbh->prepare("INSERT INTO TeamMember(idUser, idTeam, accepted) VALUES(?, ?, 1)");
    $stmt->execute(array($usrID, $teamID));

    header('Location: teamManager.php?success=1');
}

  ?>