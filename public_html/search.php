<?PHP include 'user.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="styles/resultsstyle.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
        <title>Results</title>
        <?PHP include 'nav.php'; ?>
    </head>
    <body>
    <form action="search.php" method="post">
        <!form onsubmit="window.location.href='Results.html';return false;">
    		<input type="text" name="itemName" placeholder="Find Item...">
    		<input type="submit" value="Search">
    		<input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?>>
    		<input type="hidden" name="loggedin" value="True">
    	</form>
     <hr>
        <?PHP
//construct query
    include "fun.php"; //connection
    $subquery="SELECT name, upc FROM items WHERE
    upper(name) LIKE upper('%" .$_POST["itemName"] ."%')";
    $query="SELECT s1.upc, name, price, on_hand FROM 
        ( (SELECT * FROM sells WHERE store = $store) s0
           NATURAL JOIN ($subquery) s1) s1";
//build array
    $sqlquery=$conn->prepare($query);
    $sqlquery->execute();
    $i;
    for($i = 0; $row = $sqlquery->fetch(); $i++)
    {
        $items [$i] = array('Item'=>$row[0], 'Price'=>$row[1], 'UPC Number'=>$row[2], 'Store Count'=>$row[3]);
    }

    
    echo "<h1> Results <h1>";
    if ($i == 0)
      echo"<h1>No results found for '" .$_POST["itemName"] ."'</h1>";
    echo build_table($items); //html table
?>
    </body>
</html>