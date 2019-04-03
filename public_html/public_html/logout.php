

<?php
  unset($_POST['loggedin']);  
  session_destroy();
  header("location:index.php");
  exit();
?>

