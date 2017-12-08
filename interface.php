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
    <script src="script.js" defer></script>
    <script src="logoutConfirm.js" defer></script>
  </head>
  <body>

    <header class="interfaceHeader">
      <div class="headerContent">

        <table>
          <tr>
            <td>
              <div class="dropdown">
                <span><button id="addButton"></button></span>
                <div class="dropdown-content">
                  <form name="addListForm">
                    <input type="text" name="listName" id="listForm" placeholder="List Name"></input>
                    <select name="teamName" id="listForm">
	                  <?php
                      // print_r($_SESSION['teams']);
                      // die;
	                    foreach($_SESSION['teams'] as $team) {
	                    	echo '<option value="' . $team . '">' . $team . '</option>';
	                    }
	                  ?>
                    </select>
                    <input type="submit" name="addButton" id="listFormSubmit" value="Create"></input>
                  </form>
                </div>
              </div>
            </td>
            <td>
              <div class="dropdown">
                <span><button id="searchButton"></button></span>
                <div class="dropdown-content">
                  <form>
                    <input type="text" name="search" placeholder="Search here ..."></input>
                  </form>
                </div>
              </div>
            </td>
            <td style="width:100%;">
              <img alt="Just Do It!" style="width: 70px;" src="img/logoInterface.png" onclick="window.location.href='interface.php'">
            </td>
            <td>
              <button id="notificationButton"></button>
            </td>
            <td>
              <button id="profileButton" onclick="confirmLogout()"><? echo strtoupper($_SESSION['username'][0]); ?></button>
            </td>
          </tr>
        </table>

      </div>
    </header>


    <div class="defaultContainer">
      <div class="notesContainer">

      </div>
    </div>


    <footer>
      <br><br>
      <a href="https://github.com/ampzord/FEUP-LTW">FEUP-LTW 2017-2018</a><br>
      Francisco Silva | Rui Leixo | António Pereira | Todos os direitos reservados
    </footer>

  </body>
</html>
