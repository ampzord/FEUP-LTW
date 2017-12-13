<?php

if (isset($_POST['teamName'])){
    $teamName = $_POST['teamName'];

    $stmt = $dbh->prepare("INSERT INTO Team(name) VALUES ?");
    $stmt->execute(array($teamName));
  }

  if (isset($_POST['teamName'])){
    $teamName = $_POST['teamName'];

    $stmt = $dbh->prepare("INSERT INTO Team(name) VALUES ?");
    $stmt->execute(array($teamName));
  }

  ?>