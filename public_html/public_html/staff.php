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
          <p>Select Store</p>
                <?php
                        include "staffLogic.php";
                ?>
            <form action="adduser.php" method="post">
                <input type="submit" value="Add User">
            </form>
        </body>
</html>
