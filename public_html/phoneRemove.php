<?php
  include 'user.php';
  include 'fun.php';
  $query = "delete from phoneNumbers where employee = '$user';";
  $sqlquery=$conn->prepare($query);
  $sqlquery->execute();
  header("location:settings.php");
?>