<?php
    include "fun.php";
    if (!$conn)
    {
        echo "No connection";
    }
    //get unique permissions
    $query = "SELECT DISTINCT command FROM permissions";
    $commands = query_1D_array($query, $conn);
    //find all stores
    $query= "SELECT num FROM stores";
    $store_numbers = query_1D_array($query, $conn);
    //build drop down list to select store number
    echo "\r\n<form action='" . $_SERVER['PHP_SELF'] . "' method =\"post\"> ";
    build_dropdown($store_numbers, "store_nums");
    echo " </form>\r\n";
    if(isset($_POST['store_nums']))
    {
        $selected_store = $_POST['store_nums'];
        //query to find staff with store and job title
        $query="SELECT name, job_title, s.userid FROM
                (SELECT userid, name, job_title FROM employees) s NATURAL JOIN
                (SELECT store, employee AS userid FROM employs WHERE store = ?) e
                ORDER BY store";
        $sqlquery=$conn->prepare($query);
        $sqlquery->execute([$selected_store]);
        for($i = 0; $row = $sqlquery->fetch(); $i++)
        {
            $staff [$i] = array('Name'=>$row[0], 'Position'=>$row[1], 'uname'=>$row[2]);
        }
        //print staff
        echo "<h1> Staff Store #" . $selected_store . "</h1>\r\n";
        foreach($staff as $employee)
        {
            echo '<p>' . $employee['Name'] . ' - ' . $employee['Position'] . "</p>\r\n";
            permissions_checkbox_form($employee["uname"], $commands, $conn);
            echo "<hr>";
        }
    }
    if( isset( $_POST["changedUser"] ) )
    {
        $changedUser= $_POST["changedUser"];
        //delete old permissions
        $query = 'DELETE FROM permissions WHERE employee = ?';
        $sqlquery=$conn->prepare($query);
        $sqlquery->execute( [$changedUser] );
        //submit new permissions
        foreach($commands as $permission)
        {
            $permissionForUser = str_replace(' ', '_', $changedUser . $permission);
            if ( isset($_POST["$permissionForUser"]) )
            {
                $query = 'INSERT INTO permissions VALUES (?, ?)';
                $sqlquery=$conn->prepare($query);
                $sqlquery->execute( [ $changedUser,  $permission ] );
            }
        }
        echo "Changes Submitted!";
    }

?>