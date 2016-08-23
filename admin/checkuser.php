<?php

  function checkUser($u, $p) {
    $user = "admin";
    $password = "admin";
    if ($u == $user && $p == $password) {
      return true;
    } else return false;
  }
     
?>