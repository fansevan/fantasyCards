<?php 
  session_start();
  require_once "checkuser.php";
  if (checkUser($_SESSION["user"], $_SESSION["password"])) {
    header("Location: index.php");
    exit;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>  
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="../css/style.css"/>
  <title>Вход</title>     
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("input:not([type='submit'])").val(""); 
    });
  </script>
</head>

<body>
  <div id="page_wrapper">
    <main>
      <div id="content_wrapper">
        <?php 
        if ($_SESSION["error_auth"] == 1) {
          echo "<p style='color:red'>Неверные имя пользователя и/или пароль!</p><br/>";
          unset($_SESSION["error_auth"]);
        }
        ?>
      	<form id='checkform' method="post" action='checkauth.php'>
          <p>Введите имя: 
            <input type="text" value="" autocomplete="off" name="user"/>
          </p><br/>
          <p>Введите пароль: 
            <input type="password" value="" autocomplete="off" name="password"/>
          </p><br>
          <p>
            <input type="submit" value="Войти!"/>
          </p>
        </form>
      </div>
    </main>    
  </div>
</body>
</html>