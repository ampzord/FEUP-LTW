<?php
include_once('includes/init.php');

function getAllListsFromUser(){
  global $dbh;
  $stmt = $dbh->prepare('SELECT Team.name as teamName , List.name as listName, Task.field FROM User JOIN Team ON User.id == Team.idUser JOIN List ON Team.id == List.idGroup JOIN Task ON List.id == Task.id WHERE User.username = ?');
  $stmt->execute(array($_SESSION['username']));

  $listsInfo = $stmt->fetch();
  print_r($listsInfo);
  die;
  // $lists
}


?>
