<?php 
  session_start();
  require_once "checkuser.php";
  if (!(checkUser($_SESSION["user"], $_SESSION["password"]))) {
  	header("Location: auth.php");
  	exit;
  }   
?>