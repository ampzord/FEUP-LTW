  <?
  include_once('includes/init.php');
  // Current time
  //$timestamp = time();
  global $dbh;
  // Get last_id
  // $last_id = $_GET['last_id'];

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
    WHERE User.username == ?');

  $stmt->execute(array($_SESSION['username']));
  $messages = $stmt->fetchAll();
  // print_r($messages);
  //console_log($messages);
  //die;
  for($i = 0; $i < sizeof($messages); $i++){
    $stmt = $dbh->prepare('SELECT Task.field
      FROM Task JOIN List ON Task.idList == List.id
      WHERE List.id == ?');
    $stmt->execute(array($messages[$i]['listId']));
    $tasks = $stmt->fetchAll();
    $messages[$i]['tasks'][] = $tasks;
  }

  // In order to get the most recent messages we have to reverse twice
  //$messages = array_reverse($messages);

  // JSON encode
  echo json_encode($messages);
?>
