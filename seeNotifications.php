<?php
    include_once('includes/init.php');
    include_once('database/users.php');
    
    checkValidSession();

    global $dbh;

    if(isset($_GET['teamId']) && isset($_GET['accepted'])){
        $stmt = $dbh->prepare('UPDATE TeamMember SET accepted = 1
        WHERE TeamMember.idUser == ? AND TeamMember.idTeam == ?');
        $stmt->execute(array(getUserID(), $_GET['teamId']));
    }

    if(isset($_GET['teamId']) && isset($_GET['denied'])){
        $stmt = $dbh->prepare('DELETE FROM TeamMember
        WHERE TeamMember.idUser == ? AND TeamMember.idTeam == ?');
        $stmt->execute(array(getUserID(), $_GET['teamId']));
    }

    $stmt = $dbh->prepare('SELECT Team.name as teamName, Team.id as teamId
    FROM User JOIN TeamMember ON User.id == TeamMember.idUser
    JOIN Team ON TeamMember.idTeam == Team.id
    WHERE User.username == ? AND TeamMember.accepted == 0');

    $stmt->execute(array($_SESSION['username']));
    $messages = $stmt->fetchAll();


    echo json_encode($messages);
?>