<?php
include_once('includes/init.php');

function getAllListsFromUser(){
  global $dbh;
  $stmt = $dbh->prepare('SELECT List.id as listId, Team.name as teamName , List.name as listName
    FROM User JOIN Team ON User.id == Team.idUser
    JOIN List ON Team.id == List.idGroup
    WHERE User.username = ?');
  $stmt->execute(array($_SESSION['username']));

  $listsNames = $stmt->fetchAll();
  // print_r($listsNames);


  foreach ($listsNames as $value) {
    $i = 0;
    $structData[$value['listName']][$i] = $value['teamName'];
    $stmt = $dbh->prepare('SELECT Task.field
      FROM Task JOIN List ON Task.idList == List.id
      WHERE List.id = ?');
    $stmt->execute(array($value['listId']));
    $tasks = $stmt->fetchAll();
    for ($i=0; $i < sizeof($tasks); $i++) {
      $structData[$value['listName']][$i + 1] = $tasks[$i]['field'];
    }
  }

  print_r($structData);
  return $structData;
}


?>

<!-- SELECT List.id as listId Team.name as teamName , List.name as listName
  FROM User JOIN Team ON User.id == Team.idUser
  JOIN List ON Team.id == List.idGroup
  WHERE User.username = "admin"; -->
