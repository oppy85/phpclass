<?php
  session_start(); 
  unset($_SESSION["fname"]);
  unset($_SESSION["lname"]);
  echo "<script>window.location.href='login.php'</script>";
?>