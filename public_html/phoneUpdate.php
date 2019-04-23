<?php
  include 'user.php';
  include 'fun.php';
  
  echo $query = "select * from phoneNumbers where employee = '$user';";
  
  $sqlquery=$conn->prepare($query);
  echo "here";
  $sqlquery->execute();
  $row = $sqlquery->fetch();
  $phoneInput = "+1".$_POST["phoneInput"];
  if($row)
   echo $query2 = "update phoneNumbers set phoneNumber = '" .$phoneInput."' where employee = '$user';";
  else
    echo $query2 = "insert into phoneNumbers values('$user', '".$phoneInput."');";
  $sqlquery2=$conn->prepare($query2);
  $sqlquery2->execute();
  

  $_SESSION["phoneUpdated"]=true;
  shell_exec("java -cp \".:twilioJar.jar:\" MessageConfirmSend ".$phoneInput."");
  header("location:settings.php");
?>