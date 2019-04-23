<?PHP include 'user.php'; ?>
<!DOCTYPE html>
<html>
        <head>
            <meta charset="utf-8">
             <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <link href="styles/profilestyle.css" rel="stylesheet" type="text/css">
            <!link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
            <title> Profile </title>
            <?PHP include 'nav.php'; ?>
        </head>
        <body>
        <?PHP if ( !isset($_POST["oldPass"]) ): /*if nothing submitted yet*/?>
            <form action="<?PHP $_SERVER['PHP_SELF'] ?>" method="post">
                Enter Old Password<input type="password" name="oldPass">
                Enter New Password<input type="password" name="newPass1">
                Enter Again<input type="password" name="newPass2">
                <input type="submit" value="Submit">
            </form>
        <?PHP else : ?>
            <?PHP
            include 'fun.php';
            //get old password, note $login is retrieved from database in user.php
            $oldPassReal = query_1D_array("SELECT pw FROM employees WHERE userid = '$login'", $conn);
            $fail = False;
            if( !password_verify($_POST["oldPass"], $oldPassReal[0])){
                echo "Entered Wrong Password\r\n";
                $fail = True;
            }
            if ( $_POST["newPass1"] != $_POST["newPass2"]  ){
                echo "Password don't match!";
                $fail = True;
            }
            //update password
            if(!$fail)
            {
                $query = "UPDATE employees SET pw = ? WHERE userid = ?";
                $sqlquery=$conn->prepare($query);
                $hash = password_hash($_POST["newPass1"], PASSWORD_DEFAULT);
                $sqlquery->execute([ $hash, $login ]);
                echo "<p>Password changed!\r\n</p>";
            }
            ?>
            <form action="profile.php" method="post">
                    <input type="submit" value="Back">
            </form>
        <?PHP endif; ?>
        </body>
</html>