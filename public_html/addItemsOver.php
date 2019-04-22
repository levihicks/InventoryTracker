 <?php
    $con=mysqli_connect("localhost","akstraw","abcde","Inventory");

    $usernmae = $_POST['upc'];
    $pass = $_POST['store'];
    $info = $_POST['price'];
    $num = $_POST['on_hand'];

    if(!$con)
    {
        die('Connection Failed');
    }
    else
    {
            $query = "INSERT INTO `Inventory`.`sells` (`upc`, `store`, `price`, `on_hand`)
                VALUES ('$username','$pass','$info','$num');";
            mysql_query($query, $con) or die(mysql_error());

            echo 'Successfully added.';
            echo $query;
    }
?>