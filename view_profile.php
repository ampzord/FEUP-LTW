<!DOCTYPE html>
<html>
  <head>
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
            Your <b>Profile</b> looks good!<br> Don't forget to do your tasks!
        </div>

    <br><br>

    <div class="editTeam">
    <img src="img/avatar.png" style="width:170px;" alt="avatar">
        <?php
            include_once('database/users.php');
            $userInfo = getUserInformation();
            echo  '<div class="viewProfileBox"> <h2 style="text-align:center;">' . $userInfo['username'] . '\'s' . ' profile</h2>' .
                    '<c><b>Full Name:</b> ' . $userInfo['fullName'] . '</c>' .
                    '<p><b>Email: </b>' . $userInfo['email'] . '</p>' .
                    '<p><b>Phone Number: </b>' .  $userInfo['phoneNumber'] . '</p>' .
                    '<p><b>Country: </b>' . $userInfo['country'] . '</p>' .
                    '<p><b>Birth Date: </b>' . $userInfo['birthDate'] . '</p> </div>';
        ?>
        <br>
        <button class="editBtn" id="listFormSubmit" onclick="window.location.href='edit_profile.php'">Edit Profile</button>
        <button class="backbt" onclick="window.location.href='interface.php'">Back</button>
    </div>

    <footer>
        <br><br>
        <a href="https://github.com/ampzord/FEUP-LTW">FEUP-LTW 2017-2018</a><br>
        Francisco Silva | Rui Leixo | António Pereira | Todos os direitos reservados
    </footer>
  </body>
</html>
