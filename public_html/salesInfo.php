<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport content="width=device-width, initial-scale=1.0">
		<link href="styles/resultsstyle.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
        <title>Results</title>
        <?PHP include 'nav.php'; ?>
    </head>


<?php 
  include 'fun.php';
include 'user.php';
    $query = "select * from sales where item = '" .$_POST["test"] ."' and store=$store;";
   echo "<h1> Sales History <h1>";
   $sqlquery=$conn->prepare($query);
   $sqlquery->execute();
 
    $i=0;
    for($i = 0; $row = $sqlquery->fetch(); $i++)
   {
        $items [$i] = array('UPC'=>$row[0], 'Store'=>$row[1], 'Quantity'=>$row[2], 'Time of Sale'=>$row[3], 'Sale ID'=>$row[4]);
    }

    
    
    if ($i == 0)
      echo"<h1>No sales history found.</h1>";
    echo build_table($items);
?>

</html>
