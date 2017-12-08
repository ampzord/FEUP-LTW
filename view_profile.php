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

    <br><br><br><br><br><br><br><br>

    <div id="profile-info">
    <?php
      include_once('database/users.php');
      $userInfo = getUserInformation();
      echo  '<h2>' . $userInfo['username'] . '\'s' . ' profile</h2>' .
            '<p>FullName: ' . $userInfo['fullName'] . '</p>' .
            '<p>Email: ' . $userInfo['email'] . '</p>' .
            '<p>PhoneNumber: ' .  $userInfo['phoneNumber'] . '</p>' .
            '<p>Country: ' . $userInfo['country'] . '</p>' .
            '<p>BirthDate: ' . $userInfo['birthDate'] . '</p>';
    ?>
    <button class="editBtn" onclick="window.location.href='edit_profile.php'">Edit Profile</button>
    <button class="backbt" onclick="window.location.href='interface.php'">Back</button>
    <footer>
        <br><br>
        <a href="https://github.com/ampzord/FEUP-LTW">FEUP-LTW 2017-2018</a><br>
        Francisco Silva | Rui Leixo | António Pereira | Todos os direitos reservados
    </footer>
  </body>
</html>
