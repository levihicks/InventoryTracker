<?PHP include 'user.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="styles/profilestyle.css" rel="stylesheet" type="text/css">
        <!link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
        <title> Profile </title>
        <?PHP include 'nav.php'; ?>
    </head>
    <body>
    <h1> Profile </h1>
    <hr>
    <?PHP

// get data
    $query=null;
    $query= "SELECT * FROM employees WHERE userid = '$user'";
    $sqlquery=$conn->prepare($query);
    $sqlquery->execute();
    $tuple = $sqlquery->fetch();
    $job= $tuple[2];
//display data
?>
    <table align="center">
        <tbody><tr>
            <td><b>Name</b></td>
            <td> <?PHP echo $name ?> </td>
        </tr>
        <tr>
            <td><b>User ID</b></td>
            <td><?PHP echo $user ?></td>
        </tr>
        <tr>
            <td><b>Store Number</b></td>
            <td> <?PHP echo $store ?> </td>
        </tr>
        <tr>
            <td><b>Position</b></td>
            <td> <?PHP echo $job ?> </td>
        </tr>
    </tbody></table>


    </body>
</html>
<?PHP exit() ?>