<html>
<head>
<title> Options </title>
<link rel="stylesheet" href="style.css">
<?PHP include 'user.php'; ?>
<?PHP if ($login) : ?>
<?PHP include 'nav.php'; ?>
</head>
<body>

	<p> Welcome <?php echo $name; ?> </p>
	<hr>
	<h3> Search by item </h3>
	<form action="search.php" method="post">
		Item: <input type="text" name="itemName"><br>
		<input type="submit" value="Search">
		<input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?> >
		<input type="hidden" name="loggedin" value="True" >
	</form>
	
<?PHP endif; ?>

</body>
</html>
