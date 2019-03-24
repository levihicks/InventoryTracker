<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link href="styles/loginStyle.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
		<title>Login</title>
	</head>
	<body>
 
		<header>
			<h1>Inventory Tracker</h1>
		</header>
		<main>
			<form id="login" action="main.php" method="post">
			<!form onsubmit="window.location.href='Options.html';return false;">
				<input type="text" name="user" placeholder="Username"><br>
				<input type="password" name="pass" placeholder="Password"><br>
				<input type="submit" value="Submit">
			</form>
		</main>
	</body>
</html>
