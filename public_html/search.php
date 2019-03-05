<?PHP include 'user.php'; ?>
<html>
<head>
<title> Results </title>
<?PHP include 'nav.php'; ?>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?PHP
//construct query
	include "fun.php"; //connection
	$subquery="SELECT name, upc FROM items WHERE
	name LIKE '%" .$_POST["itemName"] ."%'";
	$query="SELECT s1.upc, name, price, on_hand FROM 
		( (SELECT * FROM sells WHERE store = $store) s0
	       NATURAL JOIN ($subquery) s1) s1";
//build array
	$sqlquery=$conn->prepare($query);
	$sqlquery->execute();
	for($i = 0; $row = $sqlquery->fetch(); $i++)
	{
		$items [$i] = array('UPC'=>$row[0], 'Item'=>$row[1], 'Price'=>$row[2], 'Store Count'=>$row[3]);
	}

	
	echo "<h1> Results <h1>";
	
	echo build_table($items); //html table
?>
 
</body>
</html>
