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
          
            <?php if( isset($_POST["removeSubmit"]) ) /* Remove User form */:?>
                <br>
                <form action="staff.php" method="post">
                    Username<input type="textbox" name="removedUser">
                    <input type="submit" value="Submit" name="removeSubmit2">
                </form>
            <?php elseif ( isset($_POST["removeSubmit2"]) ) :
                try{
                    $query = "DELETE FROM employs WHERE employee = ?";
                    $statement=$conn->prepare($query);
                    $statement->execute([ $_POST["removedUser"] ]);
                    $query = "DELETE FROM employees WHERE userid = ?";
                    $statement=$conn->prepare($query);
                    $statement->execute([ $_POST["removedUser"] ]);
                    if($statement->rowCount() > 0)
                        echo "<p> Submitted </p>";
                    else
                        echo "<p>Invalid Username</p>";
                }
                catch (PDOException $e){
                    echo "Invalid: " .$e;
                }
            ?>
            <?php else :  //if not removing user
                    echo "<p>Select Store</p>";
                    include "staffLogic.php";
            ?>
                <br>
                <form action="adduser.php" method="post">
                    <input type="submit" value="Add User">
                </form>
                <br>
                <form action="staff.php" method="post">
                    <input type="submit" value="Remove User" name="removeSubmit">
                </form>
            <?php endif; ?>
            
        </body>
</html>
