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

    <h1> Stores </h1>
    <hr>
    <?PHP
// get data
    $query=null;
    $query= "SELECT * FROM stores ORDER BY num";
    $sqlquery=$conn->prepare($query);
    $sqlquery->execute();
//display data
    include 'fun.php';
    $i;
    for($i = 0; ($row = $sqlquery->fetch()); $i++)
    {
        $stores [$i] = array('Number'=>$row[0], 'City'=>$row[1], 'Address'=>$row[2]);
    }
    echo build_table($stores);
?>

<?PHP if ( $user_permissions["staff"] == "true" ) /*Check permission */:?>
    <form action="stores.php" method="post">
        <input type="submit" value="Add Store" >
    </form>
<?PHP endif; ?>

    </body>
</html>
<?PHP exit() ?>