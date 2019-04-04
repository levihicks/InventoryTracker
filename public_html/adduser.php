<?PHP include 'user.php'; ?>
<!DOCTYPE html>
<html>
    <head>   <title>Staff</title>
                 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
                <link href="styles/resultsstyle.css" rel="stylesheet" type="text/css">
                <link href="styles/staffStyle.css" rel="stylesheet" type="text/css">
		<?PHP include 'nav.php'; ?>
	</head>
        <body>
          
            <form action="adduser.php" method="post">
                Enter Position<input type="textbox" name="Position" ><br>
                Enter Name<input type="textbox" name="name" ><br>
                Enter Username<input type="textbox" name="uname" ><br>
                Enter Password<input type="password" name="password" ><br>
                Store<select name="Store">
                    <option>1</option>
                </select><br>
                <input type="submit" value="Add User"><br>
            </form>
            <form action="staff.php" method="post">
                    <input type="submit" value="Back">
            </form>
        </body>
</html>
