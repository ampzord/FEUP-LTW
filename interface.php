<?
include_once('includes/init.php');
include_once('listsAndTasks.php');
checkValidSession();
//getAllListsFromUser();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>

    <header class="interfaceHeader">
      <div class="headerContent">

        <table>
          <tr>
            <td>
              <button id="addButton"></button>
            </td>
            <td>
              <form class="navBarform" method="get" action="search.php">
                <input type="text" name="search" id="searchButton"></input>
              </form>
            </td>
            <td style="width:100%;">
              <img alt="Just Do It!" style="width: 70px;" src="img/logoInterface.png">
            </td>
            <td>
              <button id="notificationButton"></button>
            </td>
            <td>
              <button id="profileButton" onclick="window.location.href='logout.php'"><? echo strtoupper($_SESSION['username'][0]); ?></button>
            </td>
          </tr>
        </table>

      </div>
    </header>


    <div class="defaultContainer">
      <div class="notesContainer">
        <?getAllListsFromUser();?>
      </div>
    </div>


    <footer>
      <br><br>
      <a href="https://github.com/ampzord/FEUP-LTW">FEUP-LTW 2017-2018</a><br>
      Francisco Silva | Rui Leixo | António Pereira | Todos os direitos reservados
    </footer>

  </body>
</html>
