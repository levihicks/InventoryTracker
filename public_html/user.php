<?PHP
//Connect to PostgreSQL
	$dsn="pgsql:host=localhost;dbname=alec.straw"; 
	$dbuser='alec.straw';
	$password = 'abcde';
	try{
	        $conn = new PDO($dsn, $dbuser, $password);
	}
	catch (PDOException $e){
		echo "Could not connect: " .$e;
	}
//check login on database
if (!$_POST["loggedin"])
{
	$user = $_POST["user"];
	$pass = $_POST["pass"];
	$query = "SELECT userid, pw FROM employees 
	WHERE userid = ? AND pw = ?";
    $sqlquery=$conn->prepare($query);
    $sqlquery->execute([$user, $pass]);
	$login = $sqlquery->fetch();
	if(!$login)
	{
		echo "Invalid Login! $login";
	}
}
else{
	$login = $_POST["user"];
	$user = $login;
}
if ($login)
{
	//get name
	$query=null;
	$query= "SELECT name FROM employees WHERE userid = '$user'";
	$sqlquery=$conn->prepare($query);
	$sqlquery->execute();
	$tuple = $sqlquery->fetch();
	$name= $tuple[0];
    //get working store
	$query=null;
	$query= "SELECT store FROM employs where employee = '$user'";
	$sqlquery=$conn->prepare($query);
	$sqlquery->execute();
	$tuple = $sqlquery->fetch();
	$store= $tuple[0];
	//get commands
	$query=null;
	$query = "SELECT command FROM permissions WHERE employee = '$user'";
	$sqlquery=$conn->prepare($query);
	$sqlquery->execute();
	$i = 0;
	while($row = $sqlquery->fetch())
	{
		$arrayCmds[$i] = $row[0];
		$i++;
	}
	
}
?>
