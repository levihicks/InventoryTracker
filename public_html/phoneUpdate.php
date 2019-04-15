<?php
  include 'user.php';
  include 'fun.php';
  
  echo $query = "select * from phoneNumbers where employee = '$user';";
  
  $sqlquery=$conn->prepare($query);
  echo "here";
  $sqlquery->execute();
  $row = $sqlquery->fetch();
  
  if($row)
   echo $query2 = "update phoneNumbers set phoneNumber = '" .$_POST["phoneInput"] ."' where employee = '$user';";
  else
    echo $query2 = "insert into phoneNumbers values('$user', '" .$_POST["phoneInput"] ."');";
  $sqlquery2=$conn->prepare($query2);
  $sqlquery2->execute();
  header("location:settings.php");
  ?>