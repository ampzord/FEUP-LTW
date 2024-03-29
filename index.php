<?
include_once('includes/init.php');

if(isset($_SESSION['username']))
  header('Location: interface.php');

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Just Do It!!</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
        if(isset($_GET['erro'])) 
            {
                if($_GET['erro'] == 'loginInvalid'){
                    echo "<script type='text/javascript'>alert('Invalid Username or Password! Try again.');</script>";
                }
        }
    ?>

  </head>
  <body>
        
    <header>
      <img alt="Just Do It!" style="width: 200px;" src="img/logo.png">
    </header>

    <br><br><br><br><br><br><br><br>

    <div class="content">
      <div class="presentationBox">
        Need to save your <b>tasks</b>?<br> You can do it now in a safe place!
      </div>

      <div class="loginForm">
        <form id="loginForm" method="post" action="action_login.php">
          <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
          <input name="username" type="text" autocomplete="on" placeholder="Username" required>
          <input name="password" type="password" autocomplete="on" placeholder="Password" required>
          <input type="submit" value="Login">
        </form>
        <button class="backbt" onclick="window.location.href='register.php'">Register</button>
      </div>
    </div>


    <footer>
      <br><br>
      <a href="https://github.com/ampzord/FEUP-LTW">FEUP-LTW 2017-2018</a><br>
      Francisco Silva | Rui Leixo | António Pereira | Todos os direitos reservados
    </footer>

  </body>
</html>
