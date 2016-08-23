<?php 
  session_start();
  require_once "checkuser.php"; 
  $user = htmlspecialchars($_POST["user"]);
  $password = htmlspecialchars($_POST["password"]);
   
  if (checkUser($user, $password)) {
  	$_SESSION["user"] = $user;
  	$_SESSION["password"] = $password;
  } 
  else $_SESSION["error_auth"] = 1;
  header("Location: " . $_SERVER["HTTP_REFERER"]);
  exit;
?>