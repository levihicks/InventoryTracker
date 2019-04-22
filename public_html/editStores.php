<?PHP include 'user.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="styles/profilestyle.css" rel="stylesheet" type="text/css">
        <!link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
        <title> Stores </title>
        <?PHP include 'nav.php'; ?>
    </head>
    <body>
<form action="stores.php" method="post">
        <input type="submit" value="Back">
    </form>
    <h1> Stores </h1>
    <hr>
    
    <?PHP if ( !( isset($_POST["removeStore"]) || isset($_POST["addStore"]) || isset($_POST["removeStoreFinal"]) ) ) : ?>
        <h3>Remove Store</h3>
        <form action="editStores.php" method="post">
            <input type="textbox" name="removedStore">
            <input type="submit" value="Submit" name="removeStore">
        </form>
        <h3>Add Store</h3>
        <form action="editStores.php" method="post">
            Number:<input type="textbox" name="newNum"> <br>
            City:<input type="textbox" name="newCity"> <br>
            Address:<input type="textbox" name="newAddr"> <br>
            <input type="submit" value="Submit" name="addStore"> <br>
        </form>
    <?PHP endif; ?>
    <?PHP if ( isset($_POST["removeStore"]) ):/*confirm Removal */ ?>
        <p>Are you sure you want to delete this store?</p>
        <form method="post">
            <input type="hidden" value="<?PHP echo $_POST["removedStore"]?>" name="removedStore">
            <input type="submit" value="Submit" name="removeStoreFinal">
        </form>
    <?PHP
        endif;  //for removal confirmation
        //process Removal 
        if ( isset($_POST["removeStoreFinal"]) ) 
        {
            try{
                $query = "DELETE FROM employs WHERE store = ?";
                $sqlquery=$conn->prepare($query);
                $sqlquery->execute([ (int)$_POST["removedStore"] ]);
                $query = "DELETE FROM stores WHERE num = ?";
                $sqlquery=$conn->prepare($query);
                $sqlquery->execute([ (int)$_POST["removedStore"] ]);
                echo "<p> Store ".$_POST["removedStore"]." removed.</p>";
            }
            catch (PDOException $e){
                echo "Query Invalid: " .$e;
            }
        }
        //process additon 
        if ( isset($_POST["addStore"]) )
        {
            try{
                $query = "INSERT INTO stores VALUES (?, ?, ?)";
                $sqlquery=$conn->prepare($query);
                $sqlquery->execute([ (int)$_POST["newNum"], $_POST["newCity"],
                                    $_POST["newAddr"] ]);
                echo "<p> New store added.</p>";
            }
            catch (PDOException $e){
                echo "Query Invalid: " .$e;
            }
        }
    ?>

    
    </body>
</html>
<?PHP exit() ?>