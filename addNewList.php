  <?php
  // Current time
  //$timestamp = time();

  // Get last_id
  $last_id = $_GET['last_id'];

  // Database connection
  /*$dbh = new PDO('sqlite:chat.db');
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/

  if (isset($_GET['listName']) && isset($_GET['teamName'])) {
    // GET username and text
    $listName = $_GET['listName'];
    $teamName = $_GET['teamName'];

    // Insert Message

    $idGroupQuery = $dbh->prepare("SELECT id FROM Team WHERE Team.name == ?");
    $teamTable = $idGroupQuery->execute(array($teamName));
    $idTeam = $teamTable['id'];


    $stmt = $dbh->prepare("INSERT INTO List(name, idGroup) VALUES (?, ?)");
    $stmt->execute(array($listName, $idTeam));
  }

  // Retrieve new messages
  $stmt = $dbh->prepare('SELECT List.id as listId, Team.name as teamName , List.name as listName
    FROM User JOIN Team ON User.id == Team.idUser
    JOIN List ON Team.id == List.idGroup
    WHERE User.username = ?');
  $stmt->execute(array($last_id));
  $messages = $stmt->fetchAll();

  // In order to get the most recent messages we have to reverse twice
  //$messages = array_reverse($messages);

  // JSON encode
  echo json_encode($messages);
?>
