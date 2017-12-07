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
    <h2><?php echo $username;?>'s profile</h2>
    <p>FullName: <?php echo $fullName;?></p>
    <p>email <?php echo $email;?></p>
    <p>phoneNumber <?php echo $phoneNumber;?></p>
    <p>country <?php echo $country;?></p>
    <p>birthDate <?php echo $birthDate;?></p>

    <button class="backbt" onclick="window.location.href='interface.php'">Back</button>
    <footer>
        <br><br>
        <a href="https://github.com/ampzord/FEUP-LTW">FEUP-LTW 2017-2018</a><br>
        Francisco Silva | Rui Leixo | António Pereira | Todos os direitos reservados
    </footer>
  </body>
</html>

<?php
if ($user === $_SESSION['username']) { ?>

<form method="get" action="edit_profile.php">
    <input type="hidden" name="username" value="<?php echo $user;?>"/>
    <input type="submit" value="Edit Profile"/>
</form>

<?php } ?>
