<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <form id="loginForm" method="post" action="database/action_login.php">
          <input name="username" type="text" autocomplete="true" placeholder="Username">
          <input name="password" type="password" autocomplete="true" placeholder="Password">
          <input type="submit" value="Login">
        </form>
        <button class="backbt" onclick="window.location.href='register.php'">Register</button>
      </div>
    </div>


    <footer>
      <br><br>
      <a href="https://github.com/ampzord/FEUP-LTW">FEUP-LTW 2017-2018</a><br>
      Francisco Silva | Rui Leixo | António | Todos os direitos reservados
    </footer>

  </body>
</html>
