<html>
<head>
<title> Profile </title>
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
<h1> Profile </h1>
<hr>
<?PHP
include 'user.php';
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
