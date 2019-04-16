<?PHP include 'user.php'; include 'fun.php' ?>
<!DOCTYPE html>
<html>
    <head>   <title>Staff</title>
                 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
                <link href="styles/resultsstyle.css" rel="stylesheet" type="text/css">
                <link href="styles/staffStyle.css" rel="stylesheet" type="text/css">
		<?PHP include 'nav.php'; ?>
	</head>
        <body>
          <?PHP if ( !isset($_POST["submit"]) ) : ?>
            <form action="adduser.php" method="post">
                Position<input type="textbox" name="Position" ><br>
                Name<input type="textbox" name="Name" ><br>
                Username<input type="textbox" name="Uname" ><br>
                Password<input type="password" name="Password" ><br>
                Store<select name="Store">
                    <option value="">Select...</option>
                <?PHP
                //store options
                    $store_numbers = query_1D_array("SELECT num FROM stores", $conn);
                    foreach($store_numbers as $option){
                        echo ' <option value="' . $option . '">';
                        echo $option . "</option>\r\n";
                    }
                ?>
                </select><br>
                <input type="submit" value="Submit" name="submit"><br><br>
            </form>
            <?PHP
                else:
                $attributes = array("Position", "Name", "Uname","Password", "Store");
                //check valuse are set
                $missing = false;
                foreach($attributes as $key)
                {
                    if ( isset($_POST[$key]) && ( strlen($_POST[$key]) > 1 || $key == "Store" ) )
                        $attributes[$key] = $_POST[$key];
                    else{
                        echo "<p> $key is required";
                        $missing = true;
                    }
                }
                //if none missing then try to add user
                if ($missing !== true){
                    try{
                        $query = "INSERT INTO employees VALUES (?, ?, ?, ?)";
                        $sqlquery=$conn->prepare($query);
                        $sqlquery->execute([ $_POST["Uname"], $_POST["Name"],
                                            $_POST["Position"], $_POST["Password"] ]);
                        $query = "INSERT INTO employs VALUES (?, ?);";
                        $sqlquery=$conn->prepare($query);
                        $sqlquery->execute([ $_POST["Store"], $_POST["Uname"] ]);
                        echo "<p> New user added.</p>";
                    }
                    catch (PDOException $e){
                        echo "Query Invalid: " .$e;
                    }
                    
                }
            ?>
            <?PHP endif; ?>
            <form action="staff.php" method="post">
                    <input type="submit" value="Back">
            </form>
        </body>
</html>
