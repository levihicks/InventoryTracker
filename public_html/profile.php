<?PHP include 'user.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title> Profile </title>
<?PHP include 'nav.php'; ?>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1> Profile </h1>
<hr>
<?PHP
// get data
	$query=null;
	$query= "SELECT * FROM employees WHERE userid = '$user'";
	$sqlquery=$conn->prepare($query);
	$sqlquery->execute();
	$tuple = $sqlquery->fetch();
	$job= $tuple[2];
//display data
?>
<table>
    <tr>
        <td><b>Name</b></td>
        <td> <?PHP echo $name ?> </td>
    </tr>
    <tr>
        <td><b>User ID</b></td>
        <td> <?PHP echo $user ?> </td>
    </tr>
    <tr>
        <td><b>Store Number</b></td>
        <td> <?PHP echo $store ?> </td>
    </tr>
    <tr>
        <td><b>Position</b></td>
        <td> <?PHP echo $job ?> </td>
    </tr>
</table>
</body>
</html>
<?PHP exit() ?>