<?php
	$secret = $_POST["secretWord"];
	if ("44fdcv8jf3" != $secret) exit; // note the same secret as the app - could be let out if this check is not required. secretWord is not entered by the user and is used to prevent unauthorized access to the database
	
	$item1 = $_POST['upc'];
	$item2 = $_POST['store'];
	$item3 = $_POST['price'];
	$item4 = $_POST['on_hand'];
	
// POST items should be checked for bad information before being added to the database.

//change the following line
// Create connection
	$mysqli=mysqli_connect("127.0.0.1","akstraw","abcde","Inventory"); // localhost, user name, user password, database name
 
// Check connection
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
    $query = "INSERT INTO `sells` 
    (
        upc, store, price, on_hand
    ) 
    VALUES (?, ?, ?, ?)";

    $stmt = $mysqli->prepare($query);  //Prepare
    $stmt->bind_param("sidi", $item1, $item2, $item3, $item4);  //Bind
    $stmt->execute();//Execute
    if($stmt->affected_rows === 0) exit('Nothing was inserted.');  //Check to see if it worked
    $stmt->close();

	$result = mysqli_query($mysqli,$query);

    echo $result; // sends 1 if insert worked
    
?>