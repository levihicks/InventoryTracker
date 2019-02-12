<html>
<head>
<title> Results </title>
<?PHP include 'nav.php'; ?>
<style>
table, th, td {
    border: 1px solid black;
	border-collapse: collapse;
	padding: 10px;
}
</style>
</head>
<body style="text-align:center;background-color:gray;" text="white">

<?PHP
//construct query
    include 'user.php';
	include "fun.php"; //connection
	$subquery="SELECT name, upc FROM items WHERE
	name LIKE '%" .$_POST["itemName"] ."%'";
	$query="SELECT name, price FROM 
		( (SELECT upc, price FROM sells WHERE store = $store) s0
	       NATURAL JOIN ($subquery) s1) s1";
//build array
	$sqlquery=$conn->prepare($query);
	$sqlquery->execute();
	for($i = 0; $row = $sqlquery->fetch(); $i++)
	{
		$items [$i] = array('item'=>$row[0], 'price'=>$row[1]);
	}

	
	echo "<h1> Results <h1>";
	
	echo build_table($items); //html table
?>
 
</body>
</html>
