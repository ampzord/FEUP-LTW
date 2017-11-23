<?php
include_once(database/connection.php);

  global $dbh;
  $stmt = $dhh->prepare('SELECT * FROM User WHERE username = ?');
  $stmt->execute(array($_POST['username']));

  if($stmt->fetch()){
    echo 'Username ' + $_POST['username'] + ' already exists\n';
  }

// Insert na tabela
  // $stmt = $dhh->prepare('SELECT * FROM User WHERE username = ?');
  // $stmt->execute(array($_POST['username']));


?>
