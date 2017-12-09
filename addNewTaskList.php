  <?
  include_once('includes/init.php');

  global $dbh;

  if (isset($_GET['listName']) && isset($_GET['teamName'])) {
    // GET username and text
    $listName = $_GET['listName'];
    $teamName = $_GET['teamName'];

    // Insert Message

    $idGroupQuery = $dbh->prepare("SELECT Team.id
      FROM Team JOIN User ON User.id == Team.idUser
      WHERE Team.name == ?");

    $idGroupQuery->execute(array($teamName));
    $teamTable = $idGroupQuery->fetch();
    $idTeam = $teamTable['id'];


    $stmt = $dbh->prepare("INSERT INTO List(name, idGroup) VALUES (?, ?)");
    $stmt->execute(array($listName, $idTeam));

    $stmt = $dbh->prepare("SELECT * FROM List");
    $stmt->execute();
  }

  if (isset($_GET['taskValue']) && isset($_GET['listId'])) {
    // GET username and text
    $listID = $_GET['listId'];
    $taskValue = $_GET['taskValue'];

    //Assert if the User has access to that list
    $stmt = $dbh->prepare('SELECT *
    FROM User JOIN Team ON User.id == Team.idUser
    JOIN List ON Team.id == List.idGroup
    WHERE User.username == ? AND List.id == ?');

    $stmt->execute(array($_SESSION['username'], $listID));
    if($stmt->fetch()){
      $stmt = $dbh->prepare("INSERT INTO Task(field, idList) VALUES (?, ?)");
      $stmt->execute(array($taskValue, $listID));
    }
    
  }

  // Retrieve new messages
  $stmt = $dbh->prepare('SELECT List.id as listId, Team.name as teamName , List.name as listName
    FROM User JOIN Team ON User.id == Team.idUser
    JOIN List ON Team.id == List.idGroup
    WHERE User.username == ?');

  $stmt->execute(array($_SESSION['username']));
  $messages = $stmt->fetchAll();


  for($i = 0; $i < sizeof($messages); $i++){
    $stmt = $dbh->prepare('SELECT Task.field
      FROM Task JOIN List ON Task.idList == List.id
      WHERE List.id == ?');
    $stmt->execute(array($messages[$i]['listId']));
    $tasks = $stmt->fetchAll();
    $messages[$i]['tasks'] = $tasks;
  }


  // JSON encode
  echo json_encode($messages);
?>
