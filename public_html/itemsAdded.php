<?php
    $host='localhost';
    $user='akstraw';
    $password='abcde';

    $connection = mysql_connect($host,$user,$password);

    $upc = $_POST['upc'];
    $storeNumber = $_POST['store'];
    $price = $_POST['price'];
    $onHand = $_POST['on_hand'];

    if(!$connection)
    {
        die('Connection Failed');
    }
    else
    {
        $dbconnect = @mysql_select_db('Inventory', $connection);

        if(!$dbconnect)
        {
            die('Could not connect to Database');
        }
        else
        {
            $query = "INSERT INTO `Inventory`.`sells` (`upc`, `store`, `price`, `on_hand`) VALUES ('$upc','$storeNumber','$price','$onHand');";
            mysql_query($query, $connection) or die(mysql_error());

            echo 'Successfully added.';
            echo $query;
        }
    }
?>