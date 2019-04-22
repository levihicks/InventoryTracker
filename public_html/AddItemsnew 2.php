<?php
 

//upload this file to the root of the web host
//change to our username, password and dbname
// Create connection
$response = array();
    
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $itemUPC = $_POST['upc'];
        $storeNo = $_POST['store'];
        $price = $_POST['price'];
        $onHand = $_POST['on_hand'];
        
        $con=mysqli_connect("localhost","akstraw","abcde","Inventory");
        
        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        $stmt = $con->prepare("INSERT INTO sells (upc, store, price, on_hand) VALUES (?, ?, ?, ?)");
        $stmt->bind_param($stmt, "sidi", $upc, $storeNo, $price, $onHand);
        $result = $stmt->execute();
        
        if ($result) {
            $response['error'] = false;
            $response['message']='Team added successfully';
        } else {
            $response['error'] = true;
            $response['message']='Could not add team';
        }
} else {
        $response['error']=true;
        $response['message']='You are not authorized';
    }
    
echo json_encode($response);
    /*
// This SQL statement selects ALL from the table 'employees'
$sql = "SELECT * FROM employees";
 
// Check if there are results
if ($result = mysqli_query($con, $sql))
{
	// If so, then create a results array and a temporary one
	// to hold the data
	$resultArray = array();
	$tempArray = array();
 
	// Loop through each row in the result set
	while($row = $result->fetch_object())
	{
		// Add each row into our results array
		$tempArray = $row;
	    array_push($resultArray, $tempArray);
	}
 
	// Finally, encode the array to JSON and output the results
	echo json_encode($resultArray);
}
 */
$stmt->close();
// Close connections
mysqli_close($con);
     
?>
