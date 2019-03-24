<?php
                        include "fun.php";
                        if (!$conn){
                            echo "fail";
                        }
                        //find all stores
                        $query= "SELECT num FROM stores";
                        $store_numbers = query_1D_array($query, $conn);
                        //build drop down list to select store number
                        echo build_dropdown($store_numbers, "store_nums");
                        if(isset($_POST['store_nums']))
                        {
                                            $selected_store = $_POST['store_nums'];
                                            //query to find staff with store and job title
                                            $query="SELECT name, job_title, s.userid FROM
                                                    (SELECT userid, name, job_title FROM employees) s NATURAL JOIN
                                                    (SELECT store, employee AS userid FROM employs WHERE store = "
                                                    . $selected_store . " ) e
                                                    ORDER BY store";
                                            $sqlquery=$conn->prepare($query);
                                            $sqlquery->execute();
                                            for($i = 0; $row = $sqlquery->fetch(); $i++)
                                            {
                                                    $staff [$i] = array('Name'=>$row[0], 'Position'=>$row[1], 'uname'=>$row[2]);
                                            }
                                            $query = "SELECT DISTINCT command FROM permissions";
                                            $commands = query_1D_array($query, $conn);
                                            echo "<h1> Staff Store #" . $selected_store . "</h1>";
                                            foreach($staff as $employee)
                                            {
                                                echo '<p>' . $employee['Name'] . ' - ' . $employee['Position'];
                                                permissions_checkbox_form($employee["uname"], $commands, $conn);
                                                echo "<hr>";
                                            }
                        //echo build_table($staff); //html table
                        }
                        
                        //each staff permissions
?>