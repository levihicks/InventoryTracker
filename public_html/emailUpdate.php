<?php
  include 'user.php';
  include 'fun.php';
  
  echo $query = "select * from emails where employee = '$user';";
  
  $sqlquery=$conn->prepare($query);
  echo "here";
  $sqlquery->execute();
  $row = $sqlquery->fetch();
  
  if($row)
   echo $query2 = "update emails set email = '" .$_POST["emailInput"] ."' where employee = '$user';";
  else
    echo $query2 = "insert into emails values('$user', '" .$_POST["emailInput"] ."');";
  $sqlquery2=$conn->prepare($query2);
  $sqlquery2->execute();
  header("location:settings.php");
  ?>