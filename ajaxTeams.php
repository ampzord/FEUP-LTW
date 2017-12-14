<?php
  include_once('includes/init.php');
  checkValidSession();

  global $dbh;
  $stmt = $dbh->prepare('SELECT Team.name as team 
  FROM Team JOIN TeamMember ON TeamMember.idTeam == Team.id
  Join User ON TeamMember.idUser == User.id
  WHERE User.username == ? AND TeamMember.accepted == 1');
  $stmt->execute(array($_SESSION['username']));
  
  $messages = $stmt->fetchAll();

  echo json_encode($messages);

 ?>