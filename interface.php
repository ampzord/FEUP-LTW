<?
include_once('includes/init.php');
checkValidSession();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/script.js" defer></script>
    <script src="js/logoutConfirm.js" defer></script>
    <script src="js/dropDown.js" defer></script>
  </head>
  <body>

    <header class="interfaceHeader" style="width: 100%;">
      <div class="headerContent">

        <table style="width: 100%">
          <tr>
            <td>
              <div class="dropdown">
                <span><button id="addButton" onclick="dropDownAdd()" class="dropAdd"></button></span>
                <div class="dropdown-contentAdd" id="dropAdd">
                  <form name="addListForm">
                    <input type="text" name="listName" id="listForm" placeholder="List Name"></input>
                    <select name="teamName" id="listForm">
	                  <?php
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
                <span><button id="searchButton" onclick="dropDownSearch()" class="dropSearch"></button></span>
                <div class="dropdown-contentSearch" id="dropSearch">
                  <form>
                    <input type="text" name="search" placeholder="Search here ..."></input>
                  </form>
                </div>
              </div>
            </td>
            <td style="width:100%;">
              <img alt="Just Do It!" style="width: 70px; cursor: pointer;" src="img/logoInterface.png" onclick="window.location.href='interface.php'">
            </td>
            <td>
              <button id="notificationButton"></button>
            </td>
            <td>
              <!-- <button id="profileButton" onclick="confirmLogout()"><? echo strtoupper($_SESSION['username'][0]); ?></button> -->
              <div class="dropdown">
                <span><button class="drop" onclick="dropDownProfile()" id="profileButton" ><? echo strtoupper($_SESSION['username'][0]); ?></button></span>
                
              </div>
            </td>
            <td></td>
          </tr>
        </table>

      </div>
    </header>

    


    <div class="defaultContainer">
      <div class="notesContainer">
        

      </div>
    </div>

    <div id="dropProfile" class="dropdownProfile-content">
        <table style="height:100px;">
        <tr>
            <td>
            <br>
            <img src="img/avatar.png" style="width:170px;" alt="avatar">
            <br><br>
            </td>
        </tr>
        <tr>
            <td>
            <button id="navProfileBtTop" onClick="window.location='view_profile.php';">Profile</button>
            </td>
        </tr>
        <tr>
            <td>
            <button id="navProfileBt">Teams</button>
            </td>
        </tr>
        <tr>
            <td>
            <button id="navProfileBt">Credits</button>
            </td>
        </tr>
        <tr>
            <td>
            <button id="navProfileBtBottom" onclick="confirmLogout()">Logout</button>
            </td>
        </tr>
        </table>
    </div>

<br><br>
    <div class="foot">
      <footer>
              <br><br>
        <a href="https://github.com/ampzord/FEUP-LTW">FEUP-LTW 2017-2018</a><br>
        Francisco Silva | Rui Leixo | António Pereira | Todos os direitos reservados
        <br><br>
      </footer>
    </div>

  </body>
</html>
