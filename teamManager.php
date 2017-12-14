<?
include_once('includes/init.php');
checkValidSession();

if(isset($_GET['erro'])) 
{
    if($_GET['erro'] == 'duplicatedTeamName'){
        echo "<script type='text/javascript'>alert('Team name already exists, it must be UNIQUE! Try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Just Do It!!</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>

    <header>
      <img alt="Just Do It! - Register" style="width: 200px;" src="img/logo.png">
    </header>

    <br><br><br>
    <br><br><br>
    <br>


        <div class="presentationBox">
            Create your own <b>Team</b>!<br> Invite your friends and help each other!
        </div>

    <br><br>
    
    <div class="editTeam" >
        Add members to your team
        <form id="editTeamForm" method="post" action="manageTeams.php">
          <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
          <select name="selectedTeam" required>
              <option value="">Team</option>
          </select>
            <br>
            <input name="userInvite" type="text" pattern="[a-zA-Z]{3,15}" autocomplete="off" placeholder="*Username to Invite" required> 
            <input type="submit" name="createTeam" value="Add new">
        </form>
    </div>

    <br>

    <div class="createTeam" >
        Create a new Team
        <form id="createTeamForm" method="post" action="manageTeams.php">
          <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
          <input name="teamName" type="text" pattern="[a-zA-Z]{3,15}" autocomplete="off" placeholder="*Team Name (Must be Unique)" required> 
          <br>
          <input type="submit" name="createTeam" value="Create">
        </form>
        <button class="backbt" onclick="window.location.href='interface.php'">Back</button>
    </div>
    <footer>
        <br><br>
        <a href="https://github.com/ampzord/FEUP-LTW">FEUP-LTW 2017-2018</a><br>
        Francisco Silva | Rui Leixo | António Pereira | Todos os direitos reservados
    </footer>
  </body>
</html>
