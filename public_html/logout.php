

<?php
  unset($_POST['loggedin']);  
  session_destroy();
  header("location:login.php");
  exit();
?>

