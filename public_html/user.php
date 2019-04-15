<?PHP
	session_start();
	//Connect to PostgreSQL
	$dsn="mysql:host=localhost;dbname=Inventory";
    
	$dbuser='akstraw';
	$password = 'abcde';
	try{
	        $conn = new PDO($dsn, $dbuser, $password);
	}
	catch (PDOException $e){
		echo "Could not connect: " .$e;
	}
//check login on database
if (!isset($_SESSION["loggedin"]))
{
  //echo "loggedin not set";
	$user = $_POST["user"];
	$pass = $_POST["pass"];
	$query = "SELECT userid, pw FROM employees 
	WHERE userid = ? AND pw = ?";
    $sqlquery=$conn->prepare($query);
    $sqlquery->execute([$user, $pass]);
	$login = $sqlquery->fetch();
	if(!$login)
	{
		echo "<div class='loginFailure'>Invalid username/password combination. Please try again.</div>";
    
	}
	else{
		$_SESSION["loggedin"] = $user;
		$_SESSION["user"] = $user;
	}
}
else{
  //echo "loggedin set";
	$login = $_SESSION["user"];
	$user = $login;
}
if ($login)
{
  //echo"login set";
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
